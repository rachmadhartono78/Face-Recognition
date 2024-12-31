import cv2
import numpy as np
import face_recognition
import os
import mysql.connector
from datetime import datetime, timedelta

import torch

print(torch.cuda.is_available())  # Check GPU availability for PyTorch

# Database configuration
db_config = {
    'host': 'localhost',
    'user': 'root',
    'password': '',
    'database': 'keyperformance'
}

# Create a MySQL connection
conn = mysql.connector.connect(**db_config)
cursor = conn.cursor()

# Paths and setup
path = 'lib/attendance'
images = []
classNames = []

# Load images and their names
myList = os.listdir(path)
print("Images found:", myList)

for cls in myList:
    curImg = cv2.imread(f'{path}/{cls}')
    if curImg is None:
        print(f"Error: Unable to read image {cls}, skipping...")
        continue
    images.append(curImg)
    classNames.append(os.path.splitext(cls)[0])

print("Class Names:", classNames)

# Function to encode faces
def findEncodings(images):
    encodeList = []
    for img in images:
        if img is None or len(img.shape) != 3 or img.shape[2] != 3:
            print("Invalid image format, skipping...")
            continue
        img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
        encode = face_recognition.face_encodings(img)
        if len(encode) > 0:
            encodeList.append(encode[0])
        else:
            print("No face detected in an image, skipping...")
    return encodeList

# Encode all known faces
encodeListKnown = findEncodings(images)
print('Encoding Complete')

# Initialize camera
cap = cv2.VideoCapture(0)  # Use webcam

# Variables for discipline tracking
last_seen_time = datetime.now()
discipline_status = 0
attendance_inserted = {}

while True:
    success, img = cap.read()
    if not success:
        print("Error: Unable to read from camera.")
        break

    # Resize and convert image
    imgS = cv2.resize(img, (0, 0), None, 0.25, 0.25)
    imgS = cv2.cvtColor(imgS, cv2.COLOR_BGR2RGB)

    facesCurFrame = face_recognition.face_locations(imgS)
    encodesCurFrame = face_recognition.face_encodings(imgS, facesCurFrame)

    current_time = datetime.now()

    if facesCurFrame:
        last_seen_time = current_time  # Reset timer when face detected

    # Discipline status check (e.g., no detection for a certain time)
    if datetime.now() - last_seen_time > timedelta(minutes=1):
        discipline_status = 1

    for encodeFace, faceLoc in zip(encodesCurFrame, facesCurFrame):
        matches = face_recognition.compare_faces(encodeListKnown, encodeFace)
        faceDis = face_recognition.face_distance(encodeListKnown, encodeFace)
        print("Face distances:", faceDis)
        matchIndex = np.argmin(faceDis)

        if matches[matchIndex]:
            name = classNames[matchIndex].upper()
            print("Match found:", name)
            y1, x2, y2, x1 = [v * 4 for v in faceLoc]
            cv2.rectangle(img, (x1, y1), (x2, y2), (0, 255, 0), 2)
            cv2.rectangle(img, (x1, y2 - 35), (x2, y2), (0, 255, 0), cv2.FILLED)
            cv2.putText(img, name, (x1 + 6, y2 - 6), cv2.FONT_HERSHEY_COMPLEX, 1, (255, 255, 255), 2)

            # Insert or update database
            if name in attendance_inserted:
                entry_time = attendance_inserted[name]['entry_time']
                working_hours = (current_time - entry_time).total_seconds() / 3600.0
                try:
                    sql_update = "UPDATE attendance SET working_hours = %s WHERE name = %s AND discipline_status = 1"
                    val_update = (working_hours, name)
                    cursor.execute(sql_update, val_update)
                    conn.commit()
                except Exception as e:
                    print(f"Error updating database: {e}")
            else:
                try:
                    entry_time = current_time
                    sql_insert = """
                        INSERT INTO attendance (name, discipline_status, entry_time, exit_count, last_exit_time, timestamp)
                        VALUES (%s, %s, %s, %s, %s, CURRENT_TIMESTAMP)
                    """
                    val_insert = (name, discipline_status, entry_time, 0, current_time)
                    cursor.execute(sql_insert, val_insert)
                    conn.commit()
                    attendance_inserted[name] = {
                        'entry_time': entry_time,
                        'exit_count': 0,
                        'last_exit_time': current_time,
                    }
                except Exception as e:
                    print(f"Error inserting into database: {e}")

    # Display video feed
    cv2.imshow("Attendance", img)
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Cleanup
cap.release()
cv2.destroyAllWindows()
cursor.close()
conn.close()
