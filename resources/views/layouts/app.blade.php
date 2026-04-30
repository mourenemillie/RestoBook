<!DOCTYPE html>
<html lang="id">
<<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RestoBook - Booking Restoran & Cafe Lampung</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 text-slate-900">
    <nav class="bg-white sticky top-0 z-50 shadow-sm py-4">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="w-10 h-10 bg-orange-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">R</div>
                <span class="text-2xl font-bold text-slate-800">Resto<span class="text-orange-600">Book</span></span>
            </div>
            <div class="hidden md:flex space-x-8 font-medium">
                <a href="#" class="text-orange-600 border-b-2 border-orange-600">Home</a>
                <a href="#" class="hover:text-orange-600 transition">Explore</a>
                <a href="#" class="hover:text-orange-600 transition">Reservations</a>
            </div>
            <div class="flex gap-4 items-center">
                <a href="/login" class="font-semibold text-slate-700">Sign In</a>
                <a href="/register" class="bg-orange-600 text-white px-6 py-2 rounded-full font-semibold hover:bg-orange-700 transition shadow-lg shadow-orange-200">Sign Up</a>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="bg-slate-900 text-white py-12 mt-20">
        <div class="container mx-auto px-6 grid md:grid-cols-3 gap-8 text-center md:text-left">
            <div>
                <h3 class="text-xl font-bold mb-4">RestoBook</h3>
                <p class="text-slate-400">Solusi terbaik untuk reservasi restoran di wilayah Bandar Lampung.</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                <ul class="text-slate-400 space-y-2">
                    <li><a href="#" class="hover:text-white">Tentang Kami</a></li>
                    <li><a href="#" class="hover:text-white">Bantuan</a></li>
                    <li><a href="#" class="hover:text-white">Syarat & Ketentuan</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4">Social Media</h3>
                <div class="flex justify-center md:justify-start space-x-4">
                    <span class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center">IG</span>
                    <span class="w-10 h-10 bg-slate-800 rounded-full flex items-center justify-center">FB</span>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>