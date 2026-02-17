"""
Configuration untuk Face Recognition API
"""
import os
from pydantic_settings import BaseSettings

class Settings(BaseSettings):
    # API Configuration
    APP_NAME: str = "Face Recognition API"
    VERSION: str = "1.0.0"
    HOST: str = "0.0.0.0"
    PORT: int = 5000
    DEBUG: bool = True
    
    # Database
    DB_HOST: str = os.getenv("DB_HOST", "localhost")
    DB_PORT: int = int(os.getenv("DB_PORT", "3306"))
    DB_NAME: str = os.getenv("DB_NAME", "face_recognition")
    DB_USER: str = os.getenv("DB_USER", "root")
    DB_PASSWORD: str = os.getenv("DB_PASSWORD", "")
    
    @property
    def DATABASE_URL(self):
        return f"mysql+pymysql://{self.DB_USER}:{self.DB_PASSWORD}@{self.DB_HOST}:{self.DB_PORT}/{self.DB_NAME}"
    
    # Face Recognition
    FACE_DETECTION_MODEL: str = "hog"  # hog atau cnn
    FACE_RECOGNITION_TOLERANCE: float = 0.6
    FACE_ENCODING_MODEL: str = "large"
    
    # Camera
    DEFAULT_CAMERA_ID: int = 0
    CAMERA_WIDTH: int = 640
    CAMERA_HEIGHT: int = 480
    CAMERA_FPS: int = 30
    
    # Storage
    UPLOAD_DIR: str = "uploads"
    MODEL_DIR: str = "models"
    FACE_ENCODINGS_FILE: str = "models/face_encodings.pkl"
    
    class Config:
        env_file = ".env"
        protected_namespaces = ()

settings = Settings()
