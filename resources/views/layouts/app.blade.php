<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased bg-gray-100">

        <!-- Banner Section -->
        <x-banner />

        <!-- Main Container -->
        <div class="min-h-screen">
          

            <!-- Header Section (Page-specific header if exists) -->
            @if (isset($header))
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
            @endif

            <!-- Main Content Section -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Modals Section (if applicable) -->
        @stack('modals')

        <!-- Livewire Scripts -->
        @livewireScripts
    </body>
</html>
