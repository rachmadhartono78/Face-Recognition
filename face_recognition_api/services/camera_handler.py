"""
Camera Handler Service
Handles video streaming and frame generation
"""
import cv2
import time
from config import settings

class CameraHandler:
    def __init__(self):
        self.camera = None
        self.current_camera_id = -1
        self.fps = 0
        self.last_frame_time = 0

    def is_camera_available(self):
        if self.camera and self.camera.isOpened():
            return True
        return False

    def open_camera(self, camera_id=0):
        if self.current_camera_id == camera_id and self.is_camera_available():
            return True
            
        if self.camera:
            self.camera.release()
            
        self.camera = cv2.VideoCapture(camera_id)
        self.current_camera_id = camera_id
        
        if self.camera.isOpened():
            self.camera.set(cv2.CAP_PROP_FRAME_WIDTH, settings.CAMERA_WIDTH)
            self.camera.set(cv2.CAP_PROP_FRAME_HEIGHT, settings.CAMERA_HEIGHT)
            return True
        return False

    def get_fps(self):
        return self.fps

    def generate_frames(self, camera_id=0):
        if not self.open_camera(camera_id):
            raise Exception("Could not open camera")

        while True:
            success, frame = self.camera.read()
            if not success:
                break
            
            # Calculate FPS
            current_time = time.time()
            if self.last_frame_time > 0:
                self.fps = int(1 / (current_time - self.last_frame_time))
            self.last_frame_time = current_time

            # Encode frame
            ret, buffer = cv2.imencode('.jpg', frame)
            frame_bytes = buffer.tobytes()
            
            yield (b'--frame\r\n'
                   b'Content-Type: image/jpeg\r\n\r\n' + frame_bytes + b'\r\n')

    def generate_frames_with_recognition(self, camera_id, face_detector, face_recognizer):
        if not self.open_camera(camera_id):
            raise Exception("Could not open camera")

        while True:
            success, frame = self.camera.read()
            if not success:
                break

            # Face recognition on frame
            recognition_results = face_recognizer.recognize_frame(frame)
            
            # Draw boxes and names
            for result in recognition_results:
                (top, right, bottom, left) = result['location']
                name = result['name']
                confidence = result['confidence']
                
                # Draw box
                cv2.rectangle(frame, (left, top), (right, bottom), (0, 255, 0), 2)
                
                # Draw label
                label = f"{name} ({confidence*100:.1f}%)"
                cv2.putText(frame, label, (left, top - 10), 
                           cv2.FONT_HERSHEY_SIMPLEX, 0.5, (0, 255, 0), 2)

            # Encode frame
            ret, buffer = cv2.imencode('.jpg', frame)
            frame_bytes = buffer.tobytes()
            
            yield (b'--frame\r\n'
                   b'Content-Type: image/jpeg\r\n\r\n' + frame_bytes + b'\r\n')

    def __del__(self):
        if self.camera:
            self.camera.release()
