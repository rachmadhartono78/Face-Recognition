import cv2
import numpy as np
import face_recognition
import os
import mysql.connector
from datetime import datetime, timedelta

# Database setup
db_config = {'host': 'localhost', 'user': 'root', 'password': '', 'database': 'keyperformance'}
conn = mysql.connector.connect(**db_config)
cursor = conn.cursor()

# Load known faces
path = 'lib/attendance'
images = []
classNames = []
for cls in os.listdir(path):
    curImg = cv2.imread(f'{path}/{cls}')
    if curImg is not None:
        images.append(curImg)
        classNames.append(os.path.splitext(cls)[0])
encodeListKnown = [face_recognition.face_encodings(cv2.cvtColor(img, cv2.COLOR_BGR2RGB))[0] for img in images]

# Variables
attendance_data = {}
# cap = cv2.VideoCapture(0)
cap = cv2.VideoCapture(0)
cap.set(cv2.CAP_PROP_FRAME_WIDTH, 1280)  # Set resolusi kamera ke 1280x800
cap.set(cv2.CAP_PROP_FRAME_HEIGHT, 800)

cv2.namedWindow("Attendance", cv2.WINDOW_NORMAL)  # Buat jendela dengan ukuran yang bisa diubah
cv2.resizeWindow("Attendance", 1280, 800) 

while True:
    success, img = cap.read()
    if not success: break
    # Tambahkan padding agar frame memiliki aspek rasio 16:10
    desired_aspect_ratio = 16 / 10
    frame_height, frame_width = img.shape[:2]
    current_aspect_ratio = frame_width / frame_height

    if current_aspect_ratio < desired_aspect_ratio:
        # Tambahkan padding horizontal
        padding = int((frame_height * desired_aspect_ratio - frame_width) / 2)
        img = cv2.copyMakeBorder(img, 0, 0, padding, padding, cv2.BORDER_CONSTANT, value=[0, 0, 0])
    elif current_aspect_ratio > desired_aspect_ratio:
        # Tambahkan padding vertikal
        padding = int((frame_width / desired_aspect_ratio - frame_height) / 2)
        img = cv2.copyMakeBorder(img, padding, padding, 0, 0, cv2.BORDER_CONSTANT, value=[0, 0, 0])

    # Detect faces in the current frame
    imgS = cv2.resize(img, (0, 0), None, 0.25, 0.25)
    imgS = cv2.cvtColor(imgS, cv2.COLOR_BGR2RGB)
    facesCurFrame = face_recognition.face_locations(imgS)
    encodesCurFrame = face_recognition.face_encodings(imgS, facesCurFrame)
    current_time = datetime.now()

    for encodeFace, faceLoc in zip(encodesCurFrame, facesCurFrame):
        matches = face_recognition.compare_faces(encodeListKnown, encodeFace)
        faceDis = face_recognition.face_distance(encodeListKnown, encodeFace)
        matchIndex = np.argmin(faceDis)

        if matches[matchIndex]:
            name = classNames[matchIndex].upper()

            if name in attendance_data:
                # Update existing entry
                last_seen = attendance_data[name]['last_seen_time']
                if (current_time - last_seen).total_seconds() / 60.0 > 30:
                    attendance_data[name]['discipline_status'] = 0
                    cursor.execute("UPDATE attendance2 SET discipline_status = 0 WHERE name = %s", (name,))
                else:
                    attendance_data[name]['discipline_status'] = 1
                    working_hours = (current_time - attendance_data[name]['entry_time']).total_seconds() / 3600.0
                    attendance_data[name]['working_hours'] = working_hours
                    cursor.execute("UPDATE attendance2 SET working_hours = %s WHERE name = %s", (working_hours, name))
                attendance_data[name]['last_seen_time'] = current_time
            else:
                # Add new entry
                attendance_data[name] = {
                    'entry_time': current_time,
                    'last_seen_time': current_time,
                    'discipline_status': 1,
                    'working_hours': 0
                }
                cursor.execute(
                    "INSERT INTO attendance2 (name, entry_time, last_seen_time, discipline_status, working_hours) VALUES (%s, %s, %s, %s, %s)",
                    (name, current_time, current_time, 1, 0)
                )
            conn.commit()

            # Draw rectangle and label on video
            y1, x2, y2, x1 = [v * 4 for v in faceLoc]
            cv2.rectangle(img, (x1, y1), (x2, y2), (0, 255, 0), 2)
            cv2.rectangle(img, (x1, y2 - 35), (x2, y2), (0, 255, 0), cv2.FILLED)
            cv2.putText(img, f"{name} {'Disciplined' if attendance_data[name]['discipline_status'] == 1 else 'Not Disciplined'}",
                        (x1 + 6, y2 - 6), cv2.FONT_HERSHEY_COMPLEX, 1, (255, 255, 255), 2)

    cv2.imshow("Attendance", img)
    if cv2.waitKey(1) & 0xFF == ord('q'): break

cap.release()
cv2.destroyAllWindows()
cursor.close()
conn.close()
