import cv2
import numpy as np
import face_recognition
import os

# Path ke direktori gambar
path = 'lib/attendance'
images = []
classNames = []

# Baca file dalam direktori
myList = os.listdir(path)
print(f"Images found: {myList}")

# Baca nama file untuk kelas (tanpa ekstensi)
for cls in myList:
    classNames.append(os.path.splitext(cls)[0])

print(f"Class Names: {classNames}")

# Load gambar dari direktori
for cls in myList:
    try:
        curImg = cv2.imread(f'{path}/{cls}')
        if curImg is None:
            print(f"Warning: Unable to read file {cls}. Skipping...")
            continue
        images.append(curImg)
    except Exception as e:
        print(f"Error reading file {cls}: {e}")

# Fungsi untuk menemukan encoding
def findEncodings(images):
    encodeList = []
    for img in images:
        try:
            # Pastikan gambar tidak kosong dan dalam format yang benar
            if img is None:
                print("Warning: Invalid or corrupted image detected, skipping...")
                continue

            # Validasi format gambar
            if len(img.shape) != 3 or img.shape[2] != 3:
                print("Warning: Image not in RGB format, skipping...")
                continue

            # Konversi ke RGB
            img_rgb = cv2.cvtColor(img, cv2.COLOR_BGR2RGB)

            # Ekstrak encoding wajah
            encodings = face_recognition.face_encodings(img_rgb)
            if len(encodings) > 0:
                encodeList.append(encodings[0])
            else:
                print("Warning: No face detected in this image, skipping...")
        except Exception as e:
            print(f"Error processing image: {e}")
    return encodeList

# Proses encoding
print("Processing images for encodings...")
encodeListKnown = findEncodings(images)
print(f"Encodings complete. Total faces encoded: {len(encodeListKnown)}")

# Placeholder: Tambahkan logika deteksi wajah atau kehadiran di sini
print("Program completed successfully.")
