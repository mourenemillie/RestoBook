<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RestoBook - Search & Discovery')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': '#a33900',
                        'surface-warm': '#fff8f6',
                        'on-surface': '#261813',
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    borderRadius: {
                        'DEFAULT': '1rem',
                        'lg': '2rem',
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #f5f7f4; font-family: 'Plus Jakarta Sans', sans-serif; }
        .soft-shadow { box-shadow: 0 25px 50px -12px rgba(0,0,0,0.08); }
    </style>
</head>
<body class="antialiased flex flex-col min-h-screen">
    @include('partials.navbar')

    <main class="flex-grow w-full max-w-7xl mx-auto px-4 md:px-12 py-8">
        @yield('content')
    </main>

    @include('partials.footer')
</body>
</html>