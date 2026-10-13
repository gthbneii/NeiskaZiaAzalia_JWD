<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Selamat Datang - Portal Data Sertifikasi</title>

    <!-- font 1 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    {{-- font 2 --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 8%;
            background: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .logo {
            font-size: 1.4rem;
            font-weight: 700;
            color: #36C5D8;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-links a {
            text-decoration: none;
            padding: 10px 22px;
            background-color: #36C5D8;
            color: white;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: background 0.3s ease;
        }

        .nav-links a:hover {
            background-color: #2baab9;
        }

        .hero {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 50px 20px;
            background: linear-gradient(135deg, #f5fbfd 0%, #ffffff 100%);
        }

        .hero-content {
            max-width: 750px;
        }

        .hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
            line-height: 1.3;
        }

        .hero h1 span {
            color: #36C5D8;
        }

        .hero p {
            font-size: 1.05rem;
            color: #6c757d;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .btn-primary-custom {
            text-decoration: none;
            padding: 14px 30px;
            background-color: #36C5D8;
            color: white;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(54, 197, 216, 0.3);
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-primary-custom:hover {
            background-color: #2baab9;
            transform: translateY(-2px);
        }

        footer {
            text-align: center;
            padding: 20px;
            background: #ffffff;
            border-top: 1px solid #eeeeee;
            font-size: 0.85rem;
            color: #888;
        }
    </style>
</head>

<body>

    <!-- Header / Navbar -->
    <header>
        <a href="/" class="logo">
            <i class="fa-solid fa-certificate"></i> Portal Sertifikasi
        </a>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Selamat Datang di Sistem Data <span>Peserta Sertifikasi</span></h1>
            <p>Platform terintegrasi untuk mengelola data peserta, skema ujian, dan administrasi sertifikasi secara
                cepat serta efisien.</p>
            <div>
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn-primary-custom">Masuk ke Dashboard <i
                                class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i></a>
                    @else
                        <a href="{{ route('login') }}" class="btn-primary-custom">Masuk ke Halaman Login <i
                                class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i></a>
                    @endauth
                @endif
            </div>
        </div>
    </section>

    <!-- bagian bawah footernya -->
    <footer>
        &copy; {{ date('Y') }} Neiska Zia Azalia_JWD. All rights reserved.
    </footer>

</body>

</html>
