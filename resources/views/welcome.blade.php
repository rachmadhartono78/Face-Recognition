<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>UIIDashy</title>
    
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- Styles -->
    <style>
        body {
            font-family: 'Nunito';
            transition: background-color 0.3s ease, color 0.3s ease;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        
        :root {
            --bg-light: #f7fafc;
            --text-light: #1a202c;
            --bg-dark: #1a202c;
            --text-dark: #f7fafc;
            --link-light: #1a202c;
            --link-dark: #90cdf4;
        }
        
        body.light-mode {
            background-color: var(--bg-light);
            color: var(--text-light);
        }

        body.dark-mode {
            background-color: var(--bg-dark);
            color: var(--text-dark);
        }
        
        .toggle-btn {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 10px 20px;
            background-color: #3182ce;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .container {
            text-align: center;
            padding: 2rem;
            border-radius: 8px;
            background: white;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .dark-mode .container {
            background: #2d3748;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.6);
        }

        a {
            color: var(--link-light);
            text-decoration: none;
            font-weight: bold;
        }
        
        .dark-mode a {
            color: var(--link-dark);
        }

        .or-text {
            color: #4a5568; /* Gray-600 di Light Mode */
        }
        .dark-mode .or-text {
            color: #cbd5e0; /* Gray-400 di Dark Mode */
        }

    </style>
</head>

<body>
    <button class="toggle-btn" onclick="toggleDarkMode()">Switch to Dark Mode</button>
    <div class="container">
        <h1 class="text-4xl font-bold">Selamat Datang di UIIDashy</h1>
        <div class="mt-6">
            <img alt="Universitas Islam Indonesia" class="mx-auto mb-4" height="100"
                src="{{ asset('images/logo/logo.png') }}" />
        </div>
        @if (Route::has('login'))
        <div class="mt-6 flex justify-center space-x-4">
            @auth
            <a href="{{ url('/dashboard') }}">Dashboard</a>
            @else
            <a href="{{ route('login') }}">Login</a>
            <span class="or-text">or</span>
            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif
    </div>

    <script>
        function setMode(mode) {
            document.body.classList.remove('light-mode', 'dark-mode');
            document.body.classList.add(mode);
            localStorage.setItem('theme', mode);
        }
        
        function toggleDarkMode() {
            if (document.body.classList.contains('dark-mode')) {
                setMode('light-mode');
            } else {
                setMode('dark-mode');
            }
        }
        
        (function () {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                setMode(savedTheme);
            } else {
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                setMode(prefersDark ? 'dark-mode' : 'light-mode');
            }
        })();
    </script>
</body>

</html>
