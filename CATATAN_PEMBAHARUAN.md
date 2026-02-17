# Catatan Pembaharuan Aplikasi Face Recognition
**Oleh: Rachmad Hartono**

Dokumen ini mencatat transformasi besar dari sistem skripsi original menjadi versi yang lebih modern, berbasis web, dan siap produksi.

---

## 🚀 Ringkasan Transformasi
Sistem telah diubah dari aplikasi monolitik yang berjalan di lingkungan terbatas (VM/Lokal) menjadi arsitektur **Microservices** yang bisa diakses secara luas melalui browser Google Chrome/Edge.

## 🛠 Detail Pembaharuan

### 1. Arsitektur & Infrastruktur (Microservices)
- **Baru**: Implementasi **Python Face Recognition API (FastAPI)** yang terpisah dari Laravel.
- **Baru**: **Nginx Reverse Proxy** untuk menyatukan akses web Laravel dan API Python dalam satu gerbang (Port 80).
- **Baru**: **Dockerization** lengkap untuk MySQL, Laravel, dan Python API agar instalasi file OpenCV/Dlib tidak lagi sulit.

### 2. Fitur Web & Monitoring (Web-Enabled)
- **Baru**: **Live Camera Streaming** (MJPEG) yang bisa ditonton langsung di browser tanpa perlu akses remote VM.
- [x] **Baru**: **Dashboard Statistik Terpadu** yang menampilkan:
    - Ringkasan total pegawai, pekerjaan aktif, dan rekaman data.
    - Grafik distribusi kehadiran pegawai secara visual (Bar Chart).
    - Grafik komposisi kategori pegawai (Doughnut Chart).
    - Daftar entri pegawai terbaru dengan visualisasi identitas.
- **Baru**: **Dashboard Monitoring Real-time** yang menampilkan:
  - Preview kamera dengan overlay kotak deteksi wajah.
  - Grafik metrik performa (CPU, RAM, FPS).
  - Status kesehatan API (Health Check).
  - Log pengenalan wajah terbaru.

### 3. Integrasi Backend (Laravel)
- **Baru**: **FaceRecognitionApiClient Service** untuk komunikasi cepat antar Laravel dan Python.
- **Baru**: Controller khusus monitoring untuk menangani data statistik dari AI.
- **Baru**: Route web yang rapi di bawah prefix `/monitoring`.

### 4. Performa & Optimasi
- **Peningkatan**: Latensi deteksi wajah dipercepat dengan model **HOG** yang dioptimasi.
- **Peningkatan**: Penggunaan **Asynchronous framework (FastAPI)** pada sisi Python untuk menangani request streaming yang efisien.

---

## 📊 Perbandingan Teknis

| Indikator | Versi Skripsi Original | Versi Web Update |
| :--- | :--- | :--- |
| **Akses Browser** | Tidak support/Sulit (VM-bound) | **Mendukung penuh (Chrome/Edge)** |
| **Preview Kamera** | Desktop-based/Manual | **Live Web Streaming** |
| **Instalasi** | Manual & Kompleks (Dependency Python) | **Satu Perintah (`docker-compose up`)** |
| **Monitoring** | Log text di terminal | **Visual Dashboard di Web** |
| **PHP Version** | Versi Legacy | **Teroptimasi PHP 8.4** |

### 5. Kompatibilitas & Pemeliharaan
- **Peningkatan**: Dukungan penuh untuk **PHP 8.4** dengan perbaikan pada *implicit nullable parameters* di seluruh dependensi vendor.
- **Peningkatan**: Update berkala pada library pendukung (Symfony, Termwind, Laravel core) untuk keamanan dan stabilitas jangka panjang.

---
*Catatan: Pembaharuan ini menjaga integritas basis data original skripsi namun meningkatkan cara pengguna berinteraksi dengan sistem secara signifikan.*
