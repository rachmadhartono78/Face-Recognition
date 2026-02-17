"""
Face Recognition API - Main Application
FastAPI server untuk face detection & recognition
"""
from fastapi import FastAPI, File, UploadFile, HTTPException, Query
from fastapi.responses import StreamingResponse
from fastapi.middleware.cors import CORSMiddleware
from pydantic import BaseModel
from typing import Optional, List
import uvicorn
import time
from datetime import datetime
import psutil

from services.face_detector import FaceDetector
from services.face_recognizer import FaceRecognizer
from services.camera_handler import CameraHandler
from services.database_handler import DatabaseHandler
from config import settings

# Initialize FastAPI
app = FastAPI(
    title="Face Recognition API",
    description="API untuk face detection, recognition, dan attendance monitoring",
    version="1.0.0"
)

# CORS middleware untuk Laravel
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],  # Ganti dengan domain Laravel di production
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# Initialize services
face_detector = FaceDetector()
face_recognizer = FaceRecognizer()
camera_handler = CameraHandler()
db_handler = DatabaseHandler()

# Startup time
startup_time = time.time()
last_recognition_time = None

# Pydantic models
class DetectResponse(BaseModel):
    model_config = {'protected_namespaces': ()}
    success: bool
    faces_detected: int
    faces: List[dict]
    processing_time: float

class RecognizeResponse(BaseModel):
    model_config = {'protected_namespaces': ()}
    success: bool
    recognized: bool
    employee: Optional[dict]
    confidence: Optional[float]
    processing_time: float

class AttendanceRequest(BaseModel):
    employee_id: int
    nip: str
    type: str
    timestamp: str
    image: Optional[str] = None

class HealthResponse(BaseModel):
    model_config = {'protected_namespaces': ()}
    status: str
    uptime: float
    camera_status: str
    model_loaded: bool
    database_connected: bool
    last_recognition: Optional[str]

class MetricsResponse(BaseModel):
    total_recognitions_today: int
    average_processing_time: float
    success_rate: float
    camera_fps: int
    memory_usage: str
    cpu_usage: str


@app.get("/")
async def root():
    return {
        "message": "Face Recognition API",
        "version": "1.0.0",
        "status": "running",
        "docs": "/docs"
    }


@app.post("/api/detect", response_model=DetectResponse)
async def detect_faces(image: UploadFile = File(...), return_coordinates: bool = Query(True)):
    start_time = time.time()
    try:
        image_bytes = await image.read()
        faces = face_detector.detect(image_bytes, return_coordinates)
        processing_time = time.time() - start_time
        
        return DetectResponse(
            success=True,
            faces_detected=len(faces),
            faces=faces,
            processing_time=round(processing_time, 3)
        )
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Face detection failed: {str(e)}")


@app.post("/api/recognize", response_model=RecognizeResponse)
async def recognize_face(image: UploadFile = File(...), threshold: float = Query(0.6, ge=0.0, le=1.0)):
    global last_recognition_time
    start_time = time.time()
    
    try:
        image_bytes = await image.read()
        result = face_recognizer.recognize(image_bytes, threshold)
        processing_time = time.time() - start_time
        last_recognition_time = datetime.now().isoformat()
        
        if result['recognized']:
            employee = db_handler.get_employee_by_id(result['employee_id'])
            return RecognizeResponse(
                success=True,
                recognized=True,
                employee=employee,
                confidence=result['confidence'],
                processing_time=round(processing_time, 3)
            )
        else:
            return RecognizeResponse(
                success=True,
                recognized=False,
                employee=None,
                confidence=None,
                processing_time=round(processing_time, 3)
            )
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Face recognition failed: {str(e)}")


@app.get("/api/stream")
async def stream_camera(camera_id: int = Query(0)):
    try:
        return StreamingResponse(
            camera_handler.generate_frames(camera_id),
            media_type="multipart/x-mixed-replace; boundary=frame"
        )
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Camera streaming failed: {str(e)}")


@app.get("/api/stream-with-recognition")
async def stream_with_recognition(camera_id: int = Query(0)):
    try:
        return StreamingResponse(
            camera_handler.generate_frames_with_recognition(camera_id, face_detector, face_recognizer),
            media_type="multipart/x-mixed-replace; boundary=frame"
        )
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Camera streaming failed: {str(e)}")


@app.post("/api/attendance")
async def record_attendance(request: AttendanceRequest):
    try:
        if request.type not in ['check_in', 'check_out']:
            raise HTTPException(status_code=400, detail="Invalid attendance type")
        
        attendance_id = db_handler.record_attendance(
            employee_id=request.employee_id,
            nip=request.nip,
            attendance_type=request.type,
            timestamp=request.timestamp,
            image=request.image
        )
        
        return {
            "success": True,
            "attendance_id": attendance_id,
            "message": "Attendance recorded successfully"
        }
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Failed to record attendance: {str(e)}")


@app.get("/api/health", response_model=HealthResponse)
async def health_check():
    uptime = time.time() - startup_time
    camera_status = "connected" if camera_handler.is_camera_available() else "disconnected"
    model_loaded = face_recognizer.is_model_loaded()
    database_connected = db_handler.is_connected()
    status = "healthy" if (camera_status == "connected" and model_loaded and database_connected) else "degraded"
    
    return HealthResponse(
        status=status,
        uptime=round(uptime, 2),
        camera_status=camera_status,
        model_loaded=model_loaded,
        database_connected=database_connected,
        last_recognition=last_recognition_time
    )


@app.get("/api/metrics", response_model=MetricsResponse)
async def get_metrics():
    stats = db_handler.get_today_stats()
    memory = psutil.virtual_memory()
    cpu_percent = psutil.cpu_percent(interval=1)
    camera_fps = camera_handler.get_fps()
    
    return MetricsResponse(
        total_recognitions_today=stats['total_recognitions'],
        average_processing_time=stats['avg_processing_time'],
        success_rate=stats['success_rate'],
        camera_fps=camera_fps,
        memory_usage=f"{memory.used / (1024**3):.2f}GB / {memory.total / (1024**3):.2f}GB",
        cpu_usage=f"{cpu_percent}%"
    )


@app.get("/api/employees")
async def get_employees(unit_kerja: Optional[str] = None, active_only: bool = True):
    try:
        employees = db_handler.get_employees(unit_kerja, active_only)
        return {"success": True, "total": len(employees), "employees": employees}
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Failed to get employees: {str(e)}")


@app.post("/api/train-model")
async def train_model():
    try:
        result = face_recognizer.train_model()
        return {
            "success": True,
            "message": "Model training completed",
            "total_faces_trained": result['total_faces'],
            "training_time": result['training_time']
        }
    except Exception as e:
        raise HTTPException(status_code=500, detail=f"Model training failed: {str(e)}")


if __name__ == "__main__":
    uvicorn.run("main:app", host=settings.HOST, port=settings.PORT, reload=settings.DEBUG)
