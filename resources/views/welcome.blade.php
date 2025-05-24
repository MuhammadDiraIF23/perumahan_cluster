<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda - Sistem RT</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Animate.css CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body class="bg-gradient-to-r from-gray-800 via-black to-gray-900 min-h-screen flex flex-col items-center justify-center text-gray-200">

    <div class="text-center animate__animated animate__fadeInDown z-10 relative px-4">
        <!-- Logo -->
        <img src="{{ asset('img/logo.png') }}" alt="Logo RT" class="max-w-[250px] h-auto mx-auto mb-4 drop-shadow-lg">

        <!-- Judul -->
        <h1 class="text-4xl font-bold mb-2 text-white">Selamat Datang di Sistem RT</h1>
        <p class="text-lg text-gray-300 mb-6">Kelola pengajuan, tamu, dan laporan dengan mudah.</p>

        <!-- Tombol Login -->
        <a href="{{ route('admin.login') }}" class="px-6 py-3 text-white bg-[#16a34a] hover:bg-[#15803d] shadow-lg transition-all duration-300 transform hover:scale-105 hover:shadow-2xl active:scale-95 focus:outline-none rounded-lg inline-flex items-center gap-2">
            <i class="bi bi-box-arrow-in-right"></i> Login Admin
        </a>
    </div>

    <!-- Ornamen SVG bawah -->
    <div class="absolute bottom-0 w-full z-0">
        <svg viewBox="0 0 1440 320">
            <path fill="#0d6efd" fill-opacity="0.2"
                d="M0,160L48,186.7C96,213,192,267,288,256C384,245,480,171,576,160C672,149,768,203,864,202.7C960,203,1056,149,1152,128C1248,107,1344,117,1392,122.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
    </div>

</body>

</html>