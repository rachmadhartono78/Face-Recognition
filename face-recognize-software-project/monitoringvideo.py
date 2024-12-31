import cv2
import numpy as np
import face_recognition
import mysql.connector
from datetime import datetime, timedelta
import os  # Tambahkan impor modul ini

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

# Load known face encodings and names
path = 'lib/attendance'
images = []
classNames = []
myList = os.listdir(path)
for cls in myList:
    curImg = cv2.imread(f'{path}/{cls}')
    if curImg is not None:
        images.append(curImg)
        classNames.append(os.path.splitext(cls)[0])

def findEncodings(images):
    encodeList = []
    for img in images:
        if img is None or len(img.shape) != 3:
            continue
        img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
        encodes = face_recognition.face_encodings(img)
        if encodes:
            encodeList.append(encodes[0])
    return encodeList

encodeListKnown = findEncodings(images)
print('Encoding Complete')

# Video analysis
video_path = 'C:/Users/Lenovo/Videos/CCTVUII/Camera Lift'
cap = cv2.VideoCapture(video_path)
frame_count = 0
attendance_inserted = {}
last_seen_time = datetime.now()

while cap.isOpened():
    success, img = cap.read()
    if not success:
        print("End of video or unable to read frame.")
        break

    frame_count += 1
    if frame_count % 10 != 0:  # Skip frames
        continue

    imgS = cv2.resize(img, (0, 0), None, 0.25, 0.25)
    imgS = cv2.cvtColor(imgS, cv2.COLOR_BGR2RGB)

    facesCurFrame = face_recognition.face_locations(imgS)
    encodesCurFrame = face_recognition.face_encodings(imgS, facesCurFrame)

    for encodeFace, faceLoc in zip(encodesCurFrame, facesCurFrame):
        matches = face_recognition.compare_faces(encodeListKnown, encodeFace)
        faceDis = face_recognition.face_distance(encodeListKnown, encodeFace)
        matchIndex = np.argmin(faceDis)

        if matches[matchIndex]:
            name = classNames[matchIndex].upper()
            print(f"Detected: {name}")
            current_time = datetime.now()

            if name not in attendance_inserted:
                entry_time = current_time
                try:
                    sql_insert = """
                        INSERT INTO attendance (name, discipline_status, entry_time, timestamp)
                        VALUES (%s, %s, %s, CURRENT_TIMESTAMP)
                    """
                    cursor.execute(sql_insert, (name, 0, entry_time))
                    conn.commit()
                    attendance_inserted[name] = {'entry_time': entry_time}
                except Exception as e:
                    print(f"Database error: {e}")

cap.release()
cursor.close()
conn.close()
