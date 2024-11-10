<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wuluni - Check if your email has been compromised</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar avec logo et liens -->
    <header class="bg-gray-900 text-white py-4">
        <div class="container mx-auto flex justify-between items-center">
            <!-- Logo et Navigation -->
            <a href="/" class="text-3xl font-bold">(• ᴧ •) Wuluni</a>
            <ul class="flex space-x-6">
                <li class="active"><a href="/">Home</a></li>
                <li><a href="#notifyme" class="hover:text-indigo-400">Notify Me</a></li>
                <li><a href= "{{ route('search.email') }}" class="hover:text-indigo-400">Domain Search</a></li>
                <li><a href="#about" class="hover:text-indigo-400">About</a></li>
            </ul>
            
            <!-- Profile et Logout -->
            <div class="flex items-center space-x-4">
                <!-- Vérifier si l'utilisateur est connecté -->
                @auth
                    <!-- Image de profil -->
                    <div class="relative">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        @endif
                    </div>
    
                    <!-- Dropdown de profil -->
                    <div class="relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-sm font-medium text-white focus:outline-none">
                                    <span>{{ Auth::user()->name }}</span>
                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                    </svg>
                                </button>
                            </x-slot>
    
                            <x-slot name="content">
                                <!-- Lien vers le profil -->
                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                <x-slot name="content">
                                <!-- Lien vers le profil -->
                                <x-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
    
                                <!-- Lien vers la gestion des utilisateurs, visible uniquement pour les administrateurs -->
                                @if(Auth::check() && Auth::user()->role === 'admin')
                                    <x-dropdown-link href="{{ route('admin.users.index') }}">
                                        {{ __('Gérer les Utilisateurs') }}
                                    </x-dropdown-link>
                                @endif
    
                                <!-- Déconnexion -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <x-dropdown-link href="{{ route('logout') }}"
                                        @click.prevent="$root.submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <!-- Si l'utilisateur n'est pas connecté, afficher des liens de connexion et inscription -->
                    <a href="{{ route('login') }}" class="hover:text-indigo-400">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-indigo-400">Register</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Section principale avec logo et slogan -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white py-24 text-center">
        <h1 class="text-6xl font-bold border-white border-4 p-4 inline-block rounded-lg">(• ᴧ •) Wuluni?</h1>
        <p class="text-xl mt-4">Check if your entreprise is in a data breach</p>
    </div>

    <!-- Section de recherche personnalisée -->
    <div class="py-12 bg-gradient-to-b from-blue-500 to-blue-300">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="text-center">
                <form method="POST" action="{{ route('search.email') }}" class="flex justify-center items-center bg-white rounded-full shadow-lg">
                    @csrf
                    <input type="email" name="email" placeholder="Entrez votre email" class="w-full py-4 px-6 text-lg text-gray-900 rounded-l-full focus:outline-none focus:ring-2 focus:ring-indigo-500 placeholder-gray-500" required>
                    <button type="submit" class="bg-gray-700 text-white px-8 py-4 rounded-r-full hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                        Rechercher
                    </button>
                </form>
                <p class="text-sm text-gray-300 mt-4">Utiliser Wuluni est soumis aux <a href="#" class="underline">termes d'utilisation</a></p>
            </div>
        </div>
    </div>

    <!-- Section des résultats de la recherche -->
    <div class="py-12 bg-gradient-to-r from-blue-500 to-blue-400">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="text-3xl font-bold text-white text-center mb-6">Résultats de recherche :</h2>

            <!-- Affichage des résultats -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if(isset($results))
                    @foreach($results as $site)
                        <div class="bg-white border rounded-xl shadow-lg p-6 hover:shadow-xl hover:border-indigo-500 transition">
                            <div class="flex items-center justify-between">
                                <h5 class="text-xl font-bold text-gray-900">{{ $site->name }}</h5>
                                <span class="text-sm text-red-600">Ransomware</span>
                            </div>
                            <div class="mt-4">
                                <p class="text-gray-700">
                                    L'entreprise <strong>{{ $site->name }}</strong> a été victime d'une attaque par ransomware. Les détails de l'incident sont les suivants :
                                </p>
                                <ul class="space-y-2 mt-4">
                                    @foreach($site->details as $detail)
                                        <li class="text-gray-600">
                                            <span class="block">Détails : {{ $detail->info }}</span>
                                            <a href="{{ $detail->link }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 inline-block mt-1">
                                                Voir plus d'informations <span class="ml-1">↗</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p class="text-white text-center">Aucun résultat trouvé. Essayez une autre recherche.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-4">
        <div class="container mx-auto text-center">
            <p><a href="/privacy" class="underline">Politique de confidentialité</a> | <a href="/terms" class="underline">Conditions d'utilisation</a></p>
            <p class="mt-2">
                <a href="#" class="text-blue-400"><i class="fa fa-facebook-square"></i></a>
                <a href="#" class="text-blue-400"><i class="fa fa-twitter-square"></i></a>
            </p>
        </div>
    </footer>

    <script src="//unpkg.com/alpinejs" defer></script>

</body>
</html>
