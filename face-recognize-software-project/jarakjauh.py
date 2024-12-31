import cv2
import numpy as np
import mediapipe as mp
import face_recognition
import mysql.connector
from datetime import datetime, timedelta
import torch

print("GPU Available:", torch.cuda.is_available())  # Check GPU availability

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

# Load Mediapipe Face Detection
mp_face_detection = mp.solutions.face_detection
face_detection = mp_face_detection.FaceDetection(min_detection_confidence=0.5)

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

# Encode known faces
def findEncodings(images):
    encodeList = []
    for img in images:
        if img is None or len(img.shape) != 3:
            print("Invalid image format, skipping...")
            continue
        img = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)
        encode = face_recognition.face_encodings(img)
        if len(encode) > 0:
            encodeList.append(encode[0])
        else:
            print("No face detected in an image, skipping...")
    return encodeList

encodeListKnown = findEncodings(images)
print('Encoding Complete')

# Initialize camera
cap = cv2.VideoCapture(0)
cap.set(3, 1920)  # Set width
cap.set(4, 1080)  # Set height

last_seen_time = datetime.now()
discipline_status = 0
attendance_inserted = {}

while True:
    success, img = cap.read()
    if not success:
        print("Error: Unable to read from camera.")
        break

    imgS = cv2.convertScaleAbs(img, alpha=1.5, beta=50)  # Enhance contrast and brightness
    imgRGB = cv2.cvtColor(imgS, cv2.COLOR_BGR2RGB)

    # Face Detection with Mediapipe
    results = face_detection.process(imgRGB)
    current_time = datetime.now()

    if results.detections:
        last_seen_time = current_time  # Reset timer
        for detection in results.detections:
            bboxC = detection.location_data.relative_bounding_box
            ih, iw, _ = img.shape
            x, y, w, h = int(bboxC.xmin * iw), int(bboxC.ymin * ih), \
                         int(bboxC.width * iw), int(bboxC.height * ih)
            
            face = img[y:y + h, x:x + w]
            face = cv2.resize(face, (0, 0), fx=1.5, fy=1.5)  # Upscale face crop
            faceRGB = cv2.cvtColor(face, cv2.COLOR_BGR2RGB)

            encodesCurFace = face_recognition.face_encodings(faceRGB)
            if encodesCurFace:
                face_encoding = encodesCurFace[0]
                matches = face_recognition.compare_faces(encodeListKnown, face_encoding)
                faceDis = face_recognition.face_distance(encodeListKnown, face_encoding)

                matchIndex = np.argmin(faceDis) if len(faceDis) > 0 else -1
                if matches and matches[matchIndex]:
                    name = classNames[matchIndex].upper()
                    print("Match found:", name)

                    # Draw Rectangle and Name
                    cv2.rectangle(img, (x, y), (x + w, y + h), (0, 255, 0), 2)
                    cv2.putText(img, name, (x, y - 10), cv2.FONT_HERSHEY_COMPLEX, 1, (0, 255, 0), 2)

                    # Insert or update database
                    if name not in attendance_inserted:
                        entry_time = current_time
                        sql_insert = """
                            INSERT INTO attendance (name, discipline_status, entry_time, exit_count, last_exit_time, timestamp)
                            VALUES (%s, %s, %s, %s, %s, CURRENT_TIMESTAMP)
                        """
                        val_insert = (name, discipline_status, entry_time, 0, current_time)
                        cursor.execute(sql_insert, val_insert)
                        conn.commit()
                        attendance_inserted[name] = {'entry_time': entry_time}
                        print(f"Attendance inserted for {name}")

    # Discipline check (e.g., no face detected for 1 minute)
    if datetime.now() - last_seen_time > timedelta(minutes=1):
        discipline_status = 1

    # Show video
    cv2.imshow("Attendance", img)
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Cleanup
cap.release()
cv2.destroyAllWindows()
cursor.close()
conn.close()
