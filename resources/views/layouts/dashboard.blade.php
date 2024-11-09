<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <header class="bg-gray-900 text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <a href="/" class="text-3xl font-bold">(• ᴧ •) Wuluni</a>
            <ul class="flex space-x-6">
                <li><a href="/" class="hover:text-indigo-400">Home</a></li>
                <li><a href="#notifyme" class="hover:text-indigo-400">Notify Me</a></li>
                <li><a href="{{ route('search.email') }}" class="hover:text-indigo-400">Email Search</a></li>
                <li><a href="#about" class="hover:text-indigo-400">About</a></li>
            </ul>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-4 text-center">
        <p>© {{ date('Y') }} Mon Application. Tous droits réservés.</p>
    </footer>

</body>
</html>
