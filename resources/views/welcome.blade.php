<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Face Recognition Pro - Rachmad Hartono</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- Styles -->
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --secondary: #10b981;
            --dark: #0f172a;
            --light: #f8fafc;
            --glass: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--dark);
            color: var(--light);
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1, h2, h3 {
            font-family: 'Orbitron', sans-serif;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .gradient-text {
            background: linear-gradient(90deg, #60a5fa, #34d399);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Navbar */
        nav {
            padding: 1.5rem 10%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            background: rgba(15, 23, 42, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid var(--glass-border);
        }

        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            text-decoration: none;
            color: var(--light);
        }

        .nav-links a {
            margin-left: 2rem;
            text-decoration: none;
            color: var(--light);
            font-weight: 600;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 0 10%;
            background: radial-gradient(circle at center, #1e293b 0%, #0f172a 100%);
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://www.transparenttextures.com/patterns/carbon-fibre.png');
            opacity: 0.1;
        }

        .hero h1 {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            animation: fadeInDown 1s ease-out;
        }

        .hero p {
            font-size: 1.25rem;
            max-width: 800px;
            margin-bottom: 2.5rem;
            color: #94a3b8;
            animation: fadeInUp 1s ease-out 0.2s both;
        }

        .cta-buttons {
            display: flex;
            gap: 1.5rem;
            animation: fadeInUp 1s ease-out 0.4s both;
        }

        .btn {
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
            text-transform: uppercase;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
            box-shadow: 0 4px 20px rgba(59, 130, 246, 0.4);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(59, 130, 246, 0.6);
        }

        .btn-outline {
            border: 2px solid var(--primary);
            color: var(--primary);
        }

        .btn-outline:hover {
            background-color: var(--primary);
            color: white;
        }

        /* Features Section */
        .section {
            padding: 100px 10%;
        }

        .section-title {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 4rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2.5rem;
        }

        .feature-card {
            background: var(--glass);
            border: 1px solid var(--glass-border);
            padding: 2.5rem;
            border-radius: 20px;
            transition: transform 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.15);
        }

        .feature-card i {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 1.5rem;
            display: block;
        }

        .feature-card h3 {
            margin-bottom: 1rem;
            color: var(--light);
        }

        /* Evolution Section */
        .evolution {
            background-color: #0c1222;
        }

        .evolution-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }

        .evolution-card {
            background: #1e293b;
            padding: 3rem;
            border-radius: 30px;
            position: relative;
            overflow: hidden;
        }

        .evolution-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
        }

        .before-card::before { background: #ef4444; }
        .after-card::before { background: var(--secondary); }

        .evolution-card h4 {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .evolution-list {
            list-style: none;
        }

        .evolution-list li {
            margin-bottom: 1rem;
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            color: #94a3b8;
        }

        .evolution-list i {
            margin-top: 0.25rem;
        }

        /* Footer */
        footer {
            padding: 4rem 10%;
            text-align: center;
            border-top: 1px solid var(--glass-border);
            background-color: var(--dark);
        }

        .footer-logo {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.25rem;
            margin-bottom: 1rem;
            display: block;
        }

        /* Animations */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero h1 { font-size: 3rem; }
            .evolution-grid { grid-template-columns: 1fr; }
            .nav-links { display: none; }
        }
    </style>
</head>

<body>
    <nav>
        <a href="#" class="logo">FACE<span class="gradient-text">RECOG</span>PRO</a>
        <div class="nav-links">
            <a href="#features">Fitur</a>
            <a href="#evolution">Transformasi</a>
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-outline" style="padding: 0.5rem 1.5rem;">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Login</a>
                @endauth
            @endif
            <div id="api-status" style="margin-left: 1.5rem; display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; font-weight: 600; color: #94a3b8;">
                <span id="status-dot" style="width: 10px; height: 10px; background: #64748b; border-radius: 50%; display: inline-block;"></span>
                AI <span id="status-text">OFFLINE</span>
            </div>
        </div>
    </nav>

    <section class="hero">
        <h1 class="gradient-text">UIIDashy 2.0</h1>
        <p>Sistem Terintegrasi Face Recognition & Kedisiplinan Pegawai. Solusi cerdas untuk monitoring kehadiran real-time dan analisis performa berbasis AI.</p>
        <div class="cta-buttons">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="btn btn-primary">
                        <i class="bi bi-speedometer2"></i> Menuju Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="bi bi-box-arrow-in-right"></i> Masuk Sistem
                    </a>
                    <a href="#about" class="btn btn-outline">Pelajari Sistem</a>
                @endauth
            @endif
        </div>
    </section>

    <section id="about" class="section" style="background: rgba(255,255,255,0.02);">
        <div class="row evolution-grid" style="align-items: center;">
            <div class="col-12" style="text-align: center; margin-bottom: 3rem;">
                <h2 class="section-title mb-2">Apa itu <span class="gradient-text">UIIDashy</span>?</h2>
                <p class="text-muted" style="max-width: 700px; margin: 0 auto;">Platform manajemen kehadiran modern yang menggabungkan teknologi computer vision dengan sistem manajemen SDM.</p>
            </div>
            <div class="feature-card" style="grid-column: span 2; display: flex; gap: 2rem; align-items: center; text-align: left;">
                <div class="stats-icon purple" style="width: 100px; height: 100px; flex-shrink: 0;">
                    <i class="bi bi-shield-lock-fill text-white fs-1"></i>
                </div>
                <div>
                    <h3 class="mb-2">Identity-First Monitoring</h3>
                    <p class="text-muted">Bukan sekadar absensi titik koordinat. UIIDashy memastikan identitas pegawai yang sebenarnya berada di lokasi melalui verifikasi biometrik wajah yang diproses oleh AI Microservice.</p>
                    <div class="mt-3 d-flex gap-3">
                        <span class="badge bg-primary bg-opacity-25 text-primary px-3 py-2 rounded-pill small"><i class="bi bi-cpu me-1"></i> FastAPI Engine</span>
                        <span class="badge bg-success bg-opacity-25 text-success px-3 py-2 rounded-pill small"><i class="bi bi-check-all me-1"></i> Zero Manual Input</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="section">
        <h2 class="section-title">Kenapa Upgrade ke <span class="gradient-text">Versi 2.0</span>?</h2>
        <div class="features-grid">
            <div class="feature-card">
                <i class="bi bi-webcam"></i>
                <h3>Live Monitoring</h3>
                <p>Streaming kamera langsung dari browser Chrome/Edge tanpa perlu akses remote server atau VM.</p>
            </div>
            <div class="feature-card">
                <i class="bi bi-cpu"></i>
                <h3>FastAPI Microservice</h3>
                <p>Arsitektur AI berbasis Python FastAPI yang sangat cepat dan terpisah dari logika web utama.</p>
            </div>
            <div class="feature-card">
                <i class="bi bi-box-seam"></i>
                <h3>Docker Containerized</h3>
                <p>Deploy sistem hanya dalam hitungan detik dengan Docker Compose. Tidak perlu instalasi OpenCV manual.</p>
            </div>
            <div class="feature-card">
                <i class="bi bi-graph-up-arrow"></i>
                <h3>Face Identification</h3>
                <p>Sistem kini mampu mengenali identitas wajah secara real-time dengan akurasi tinggi menggunakan model face encoding terbaru.</p>
            </div>
            <div class="feature-card">
                <i class="bi bi-lightning-charge"></i>
                <h3>Adaptive Optimization</h3>
                <p>Stream otomatis berhenti saat tab tidak aktif (Visibility Awareness) untuk menghemat penggunaan CPU dan baterai laptop.</p>
            </div>
            <div class="feature-card">
                <i class="bi bi-shield-check"></i>
                <h3>PHP 8.4 Optimized</h3>
                <p>Sistem telah diperbarui untuk mendukung versi PHP terbaru, memastikan keamanan dan performa terbaik.</p>
            </div>
        </div>
    </section>

    <section id="evolution" class="section evolution">
        <h2 class="section-title">Evolusi Proyek <span class="gradient-text">Skripsi</span></h2>
        <div class="evolution-grid">
            <div class="evolution-card before-card">
                <h4><i class="bi bi-x-circle-fill" style="color: #ef4444;"></i> Versi Skripsi Original</h4>
                <ul class="evolution-list">
                    <li><i class="bi bi-dot"></i> Terbatas pada akses lokal atau VM saja.</li>
                    <li><i class="bi bi-dot"></i> Tidak ada antarmuka monitoring kamera di web.</li>
                    <li><i class="bi bi-dot"></i> Instalasi OpenCV & Dlib yang kompleks secara manual.</li>
                    <li><i class="bi bi-dot"></i> Arsitektur monolitik yang sulit dikembangkan.</li>
                </ul>
            </div>
            <div class="evolution-card after-card">
                <h4><i class="bi bi-check-circle-fill" style="color: var(--secondary);"></i> Versi Web Update (Sekarang)</h4>
                <ul class="evolution-list">
                    <li><i class="bi bi-check2"></i> <strong>Full Web Access</strong>: Buka dari laptop mana pun via browser.</li>
                    <li><i class="bi bi-check2"></i> <strong>Real-time Dashboard</strong>: Streaming video dengan overlay deteksi.</li>
                    <li><i class="bi bi-check2"></i> <strong>One-Command Deploy</strong>: Menggunakan Docker Compose (Easy Setup).</li>
                    <li><i class="bi bi-check2"></i> <strong>Microservice Architecture</strong>: Pemisahan API Image Processing (FastAPI) dan Web UI (Laravel).</li>
                    <li><i class="bi bi-check2"></i> <strong>Real-time Face Labels</strong>: Video stream dengan overlay nama dan tingkat kepercayaan (confidence).</li>
                    <li><i class="bi bi-check2"></i> <strong>Automatic Resource Saver</strong>: Teknologi cerdas yang mematikan kamera saat tab browser tidak terbuka.</li>
                    <li><i class="bi bi-check2"></i> <strong>API-Based Training</strong>: Latih model pengenalan wajah baru hanya dengan mengunggah foto ke folder uploads.</li>
                </ul>
            </div>
        </div>
    </section>

    <footer>
        <span class="footer-logo">FACE<span class="gradient-text">RECOG</span>PRO</span>
        <p>&copy; 2026 Rachmad Hartono. Dikembangkan untuk efisiensi presensi berbasis AI.</p>
        <div style="margin-top: 1rem;">
            <img src="{{ asset('images/logo/logo.png') }}" height="40" alt="Logo UII">
        </div>
    </footer>

    <script>
        // Smooth scroll for nav links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // API Health Check
        async function checkApiStatus() {
            const statusDot = document.getElementById('status-dot');
            const statusText = document.getElementById('status-text');
            const apiUrl = 'http://localhost:5000/api/health';

            try {
                const response = await fetch(apiUrl);
                if (response.ok) {
                    const data = await response.json();
                    statusDot.style.background = data.status === 'healthy' ? '#10b981' : '#f59e0b';
                    statusText.innerText = data.status.toUpperCase();
                    statusText.style.color = data.status === 'healthy' ? '#10b981' : '#f59e0b';
                } else {
                    throw new Error('Offline');
                }
            } catch (error) {
                statusDot.style.background = '#ef4444';
                statusText.innerText = 'OFFLINE';
                statusText.style.color = '#ef4444';
            }
        }

        // Check initially and then every 10 seconds
        checkApiStatus();
        let statusInterval = setInterval(checkApiStatus, 10000);

        // Visibility Awareness: Save resources when tab is hidden
        document.addEventListener('visibilitychange', () => {
            if (document.hidden) {
                clearInterval(statusInterval);
            } else {
                checkApiStatus();
                statusInterval = setInterval(checkApiStatus, 10000);
            }
        });
    </script>
</body>

</html>
