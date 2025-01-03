import cv2
import numpy as np
import face_recognition
import os
import mysql.connector
from datetime import datetime, timedelta
from collections import defaultdict

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
attendance_data = defaultdict(lambda: {
    'entry_time': datetime.now(),  # Inisialisasi waktu saat ini
    'last_seen_time': datetime.now(),
    'discipline_status': 0,
    'working_hours': 0
})

# Initialize video capture
cap = cv2.VideoCapture(0)
cap.set(cv2.CAP_PROP_FRAME_WIDTH, 1280)
cap.set(cv2.CAP_PROP_FRAME_HEIGHT, 800)
cv2.namedWindow("Attendance", cv2.WINDOW_NORMAL)
cv2.resizeWindow("Attendance", 1280, 800)

frame_counter = 0
while True:
    success, img = cap.read()
    if not success: break
    frame_counter += 1

    # Process every 5th frame to reduce load
    if frame_counter % 5 != 0:
        cv2.imshow("Attendance", img)
        if cv2.waitKey(1) & 0xFF == ord('q'): break
        continue

    # Resize frame for face recognition
    imgS = cv2.resize(img, (640, 400))
    imgS = cv2.cvtColor(imgS, cv2.COLOR_BGR2RGB)
    facesCurFrame = face_recognition.face_locations(imgS)
    encodesCurFrame = face_recognition.face_encodings(imgS, facesCurFrame)
    current_time = datetime.now()

    for encodeFace, faceLoc in zip(encodesCurFrame, facesCurFrame):
        matches = face_recognition.compare_faces(encodeListKnown, encodeFace)
        faceDis = face_recognition.face_distance(encodeListKnown, encodeFace)
        matchIndex = np.argmin(faceDis)

        # Validate match and distance
        if matches[matchIndex] and faceDis[matchIndex] < 0.6:
            name = classNames[matchIndex].upper()

            # Check if record exists in the database
            cursor.execute("SELECT id FROM attendance2 WHERE name = %s", (name,))
            record = cursor.fetchone()

            if record:
                # Update existing record
                last_seen = attendance_data[name]['last_seen_time']

                # Validasi last_seen
                if last_seen is None:
                    attendance_data[name]['last_seen_time'] = current_time
                    last_seen = current_time

                # Perhitungan waktu
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
                # Insert new record
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
            cv2.rectangle(img, (x1, y1), (x2, y2), (0, 255, 0), 1)
            cv2.putText(img, name, (x1 + 6, y2 - 6), cv2.FONT_HERSHEY_SIMPLEX, 0.5, (255, 255, 255), 1)

    cv2.imshow("Attendance", img)
    if cv2.waitKey(1) & 0xFF == ord('q'): break

cap.release()
cv2.destroyAllWindows()
cursor.close()
conn.close()
