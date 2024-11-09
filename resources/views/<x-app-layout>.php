<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl text-gray-900">
                {{ __('Dashboard') }}
            </h2>
            <!-- Icone utilisateur pour un aspect moderne -->
            <div class="flex items-center space-x-4">
                <span class="text-gray-600">Bienvenue, {{ Auth::user()->name }}</span>
                <img class="w-10 h-10 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="User Avatar">
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gradient-to-b from-gray-50 to-gray-200">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-white shadow-2xl sm:rounded-lg p-6 transition duration-500 ease-in-out transform hover:scale-105">
        
        <!-- Barre de recherche moderne avec illustration -->
        <form method="GET" action="{{ route('search') }}" class="mb-8 flex justify-center">
            <div class="w-full max-w-3xl flex items-center bg-white shadow-lg rounded-full relative overflow-hidden">
                <!-- Illustration subtile d'arrière-plan -->
                <div class="absolute inset-0 bg-[url('/path-to-your-illustration.svg')] bg-no-repeat bg-right opacity-10 pointer-events-none"></div>
                
                <input type="text" name="query"
                    class="w-full py-4 px-6 text-lg text-gray-700 rounded-l-full focus:outline-none focus:ring-2 focus:ring-indigo-500 placeholder-gray-500 transition"
                    placeholder="🔍 Rechercher un site crawlé">
                <button type="submit"
                    class="bg-indigo-600 text-white px-8 py-4 rounded-r-full hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    Rechercher
                </button>
            </div>
        </form>

        <!-- Résultats de la recherche avec des cartes animées -->
        @if(isset($results))
            <h4 class="text-xl font-semibold text-gray-800 mb-6">Résultats de recherche :</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($results as $name => $groupedResults)
                    <div class="bg-white border rounded-xl shadow-lg p-6 hover:shadow-xl hover:border-indigo-500 transition">
                        <div class="flex items-center justify-between">
                            <h5 class="text-xl font-bold text-gray-900">{{ $name }}</h5>
                            <span class="text-sm text-red-600">Ransomware</span>
                        </div>
                        <div class="mt-4">
                            <p class="text-gray-700">
                                L'entreprise <strong>{{ $name }}</strong> a été victime d'une attaque par ransomware. Les détails de l'incident sont les suivants :
                            </p>
                            <ul class="space-y-2 mt-4">
                                @foreach($groupedResults as $result)
                                    <li class="text-gray-600">
                                        <span class="block">Détails : {{ $result->info }}</span>
                                        <a href="{{ $result->link }}" target="_blank" class="text-indigo-600 hover:text-indigo-800 inline-block mt-1">
                                            Voir plus d'informations <span class="ml-1">↗</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500 text-center">Aucun résultat trouvé. Essayez une autre recherche.</p>
        @endif

        <!-- Section d'éléments supplémentaires pour un dashboard complet -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Exemple d'élément de statistique -->
            <div class="bg-white border rounded-xl shadow-lg p-6 text-center hover:shadow-xl transition transform hover:scale-105">
                <h3 class="text-lg font-bold text-gray-900">Total des Sites Crawlés</h3>
                <p class="text-4xl font-extrabold text-indigo-600 mt-4">1,234</p>
            </div>

            <!-- Ajouter d'autres widgets pour enrichir le dashboard -->
            <!-- Exemple : Taux de recherche, nouveaux utilisateurs, etc. -->
        </div>
    </div>
</div>

    </div>
</x-app-layout>
