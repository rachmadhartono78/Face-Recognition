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
images, classNames = [], [os.path.splitext(cls)[0] for cls in os.listdir(path) if cv2.imread(f'{path}/{cls}') is not None]
encodeListKnown = [face_recognition.face_encodings(cv2.cvtColor(cv2.imread(f'{path}/{cls}'), cv2.COLOR_BGR2RGB))[0] for cls in os.listdir(path) if cv2.imread(f'{path}/{cls}') is not None]

# Variables
attendance_inserted = {}
cap = cv2.VideoCapture(0)

while True:
    success, img = cap.read()
    if not success: break

    # Detect faces
    imgS = cv2.resize(img, (0, 0), None, 0.25, 0.25)
    facesCurFrame = face_recognition.face_locations(imgS)
    encodesCurFrame = face_recognition.face_encodings(imgS, facesCurFrame)
    current_time = datetime.now()

    for encodeFace, faceLoc in zip(encodesCurFrame, facesCurFrame):
        matches = face_recognition.compare_faces(encodeListKnown, encodeFace)
        faceDis = face_recognition.face_distance(encodeListKnown, encodeFace)
        matchIndex = np.argmin(faceDis)

        if matches[matchIndex]:
            name = classNames[matchIndex].upper()

            if name in attendance_inserted:
                last_seen = attendance_inserted[name]['last_seen_time']
                if (current_time - last_seen).total_seconds() / 60.0 > 30:
                    attendance_inserted[name]['discipline_status'] = 0
                    cursor.execute("UPDATE attendance2 SET discipline_status = 0 WHERE name = %s", (name,))
                else:
                    attendance_inserted[name]['discipline_status'] = 1
                    working_hours = (current_time - attendance_inserted[name]['entry_time']).total_seconds() / 3600.0
                    cursor.execute("UPDATE attendance2 SET working_hours = %s WHERE name = %s", (working_hours, name))
                attendance_inserted[name]['last_seen_time'] = current_time
            else:
                attendance_inserted[name] = {'entry_time': current_time, 'last_seen_time': current_time, 'discipline_status': 1}
                cursor.execute("INSERT INTO attendance2 (name, entry_time, last_seen_time, discipline_status, working_hours) VALUES (%s, %s, %s, %s, %s)",
                               (name, current_time, current_time, 1, 0))
            conn.commit()

            # Display on video
            y1, x2, y2, x1 = [v * 4 for v in faceLoc]
            cv2.rectangle(img, (x1, y1), (x2, y2), (0, 255, 0), 2)
            cv2.putText(img, f"{name} {'Disciplined' if attendance_inserted[name]['discipline_status'] else 'Not Disciplined'}", 
                        (x1 + 6, y2 - 6), cv2.FONT_HERSHEY_COMPLEX, 1, (255, 255, 255), 2)

    cv2.imshow("Attendance", img)
    if cv2.waitKey(1) & 0xFF == ord('q'): break
cap.release()
cv2.destroyAllWindows()
cursor.close()
conn.close()
