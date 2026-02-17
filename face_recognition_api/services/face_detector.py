"""
Face Detector Service
Menggunakan face_recognition library untuk detect faces
"""
import face_recognition
import numpy as np
from PIL import Image
import io
import cv2


class FaceDetector:
    def __init__(self, model="hog"):
        """
        Initialize Face Detector
        
        Args:
            model: 'hog' (faster, CPU) atau 'cnn' (accurate, GPU)
        """
        self.model = model
        
    def detect(self, image_bytes, return_coordinates=True):
        """
        Detect faces dari image bytes
        
        Args:
            image_bytes: Image dalam bytes
            return_coordinates: Return koordinat faces atau tidak
            
        Returns:
            List of detected faces dengan coordinates
        """
        try:
            # Convert bytes to numpy array
            image = Image.open(io.BytesIO(image_bytes))
            image_np = np.array(image)
            
            # Convert RGB jika perlu
            if len(image_np.shape) == 2:  # Grayscale
                image_np = cv2.cvtColor(image_np, cv2.COLOR_GRAY2RGB)
            elif image_np.shape[2] == 4:  # RGBA
                image_np = cv2.cvtColor(image_np, cv2.COLOR_RGBA2RGB)
            
            # Detect faces
            face_locations = face_recognition.face_locations(image_np, model=self.model)
            
            faces = []
            for idx, (top, right, bottom, left) in enumerate(face_locations):
                face_data = {
                    "id": idx + 1,
                    "confidence": 0.98  # face_recognition tidak return confidence, set default
                }
                
                if return_coordinates:
                    face_data["coordinates"] = {
                        "top": top,
                        "right": right,
                        "bottom": bottom,
                        "left": left
                    }
                
                faces.append(face_data)
            
            return faces
            
        except Exception as e:
            raise Exception(f"Face detection error: {str(e)}")
    
    def detect_from_frame(self, frame):
        """
        Detect faces dari video frame (numpy array)
        
        Args:
            frame: Video frame (numpy array)
            
        Returns:
            List of face locations
        """
        try:
            # Resize frame untuk performa (optional)
            small_frame = cv2.resize(frame, (0, 0), fx=0.5, fy=0.5)
            rgb_frame = cv2.cvtColor(small_frame, cv2.COLOR_BGR2RGB)
            
            # Detect faces
            face_locations = face_recognition.face_locations(rgb_frame, model=self.model)
            
            # Scale back coordinates
            face_locations = [(top*2, right*2, bottom*2, left*2) 
                            for (top, right, bottom, left) in face_locations]
            
            return face_locations
            
        except Exception as e:
            raise Exception(f"Frame detection error: {str(e)}")
    
    def draw_boxes(self, frame, face_locations, color=(0, 255, 0), thickness=2):
        """
        Draw bounding boxes di frame
        
        Args:
            frame: Video frame
            face_locations: List of (top, right, bottom, left)
            color: Box color (B, G, R)
            thickness: Line thickness
            
        Returns:
            Frame dengan boxes
        """
        for (top, right, bottom, left) in face_locations:
            cv2.rectangle(frame, (left, top), (right, bottom), color, thickness)
            cv2.putText(frame, "Face", (left, top - 10), 
                       cv2.FONT_HERSHEY_SIMPLEX, 0.5, color, 2)
        
        return frame
