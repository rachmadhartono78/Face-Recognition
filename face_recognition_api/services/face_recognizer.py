"""
Face Recognizer Service
Handles face encoding and matching
"""
import face_recognition
import numpy as np
import pickle
import os
import time
import io
from PIL import Image
import cv2
from config import settings

class FaceRecognizer:
    def __init__(self):
        self.known_face_encodings = []
        self.known_face_ids = []
        self.is_loaded = False
        self.load_model()

    def load_model(self):
        """Load trained face encodings from file"""
        if os.path.exists(settings.FACE_ENCODINGS_FILE):
            try:
                with open(settings.FACE_ENCODINGS_FILE, 'rb') as f:
                    data = pickle.load(f)
                    self.known_face_encodings = data['encodings']
                    self.known_face_ids = data['ids']
                self.is_loaded = True
                print(f"Loaded {len(self.known_face_ids)} face encodings.")
            except Exception as e:
                print(f"Error loading model: {e}")
                self.is_loaded = False
        else:
            print("No model file found. Please train the model.")
            self.is_loaded = False

    def is_model_loaded(self):
        return self.is_loaded

    def recognize_frame(self, frame_np, threshold=0.6):
        """
        Recognize face from a numpy array (OpenCV frame)
        """
        if not self.is_loaded:
            return []

        try:
            # Convert BGR to RGB
            rgb_frame = cv2.cvtColor(frame_np, cv2.COLOR_BGR2RGB)

            # Find face locations and encodings
            face_locations = face_recognition.face_locations(rgb_frame)
            face_encodings = face_recognition.face_encodings(rgb_frame, face_locations)

            results = []
            for face_encoding, face_location in zip(face_encodings, face_locations):
                # Compare faces
                face_distances = face_recognition.face_distance(self.known_face_encodings, face_encoding)

                if len(face_distances) > 0:
                    best_match_index = np.argmin(face_distances)

                    if face_distances[best_match_index] <= threshold:
                        name = self.known_face_ids[best_match_index]
                        confidence = 1 - face_distances[best_match_index]
                        results.append({
                            'location': face_location,
                            'name': name,
                            'confidence': float(confidence)
                        })
                    else:
                        results.append({
                            'location': face_location,
                            'name': "Unknown",
                            'confidence': float(1 - face_distances[best_match_index])
                        })
                else:
                    results.append({
                        'location': face_location,
                        'name': "Unknown",
                        'confidence': 0.0
                    })

            return results

        except Exception as e:
            print(f"Recognition error: {str(e)}")
            return []

    def recognize_image(self, image_bytes, threshold=0.6):
        """
        Recognize face from image bytes
        """
        if not self.is_loaded:
            return {'recognized': False, 'message': 'Model not loaded'}

        try:
            image = Image.open(io.BytesIO(image_bytes))
            image_np = np.array(image)

            # Find face locations and encodings
            face_locations = face_recognition.face_locations(image_np)
            face_encodings = face_recognition.face_encodings(image_np, face_locations)

            if not face_encodings:
                return {'recognized': False, 'message': 'No face detected'}

            # We process the first face detected
            face_to_compare = face_encodings[0]

            # Compare faces
            face_distances = face_recognition.face_distance(self.known_face_encodings, face_to_compare)
            best_match_index = np.argmin(face_distances)

            if face_distances[best_match_index] <= threshold:
                employee_id = self.known_face_ids[best_match_index]
                confidence = 1 - face_distances[best_match_index]
                return {
                    'recognized': True,
                    'employee_id': employee_id,
                    'confidence': float(confidence)
                }

            return {'recognized': False, 'confidence': float(1 - face_distances[best_match_index])}

        except Exception as e:
            raise Exception(f"Recognition error: {str(e)}")

    def train_model(self):
        """
        Train the model using images from the uploads directory.
        Each subdirectory in uploads should be named after the person (ID or Name).
        """
        start_time = time.time()
        encodings = []
        ids = []

        if not os.path.exists(settings.UPLOAD_DIR):
            os.makedirs(settings.UPLOAD_DIR)

        # Check for subdirectories in uploads
        for person_name in os.listdir(settings.UPLOAD_DIR):
            person_dir = os.path.join(settings.UPLOAD_DIR, person_name)
            if not os.path.isdir(person_dir):
                continue

            for image_name in os.listdir(person_dir):
                image_path = os.path.join(person_dir, image_name)
                try:
                    image = face_recognition.load_image_file(image_path)
                    face_encs = face_recognition.face_encodings(image)

                    if face_encs:
                        encodings.append(face_encs[0])
                        ids.append(person_name)
                except Exception as e:
                    print(f"Error encoding {image_path}: {e}")

        if encodings:
            if not os.path.exists(settings.MODEL_DIR):
                os.makedirs(settings.MODEL_DIR)

            data = {'encodings': encodings, 'ids': ids}
            with open(settings.FACE_ENCODINGS_FILE, 'wb') as f:
                pickle.dump(data, f)

            self.known_face_encodings = encodings
            self.known_face_ids = ids
            self.is_loaded = True

            training_time = time.time() - start_time
            return {
                'success': True,
                'total_faces': len(ids),
                'training_time': round(training_time, 2)
            }

        return {
            'success': False,
            'message': 'No face data found in uploads directory',
            'training_time': 0
        }
