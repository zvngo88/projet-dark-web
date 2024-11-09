@extends('layouts.dashboard')

@section('content')
<!-- Section principale avec gradient et titre -->
<div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white py-24 text-center">
    <h1 class="text-6xl font-bold border-white border-4 p-4 inline-block rounded-lg">(• ᴧ •) Wuluni?</h1>
    <p class="text-xl mt-4">Check if your email is in a data breach</p>
</div>

<!-- Section des résultats -->
<div class="py-12 bg-gradient-to-b from-blue-500 to-blue-300">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-white mb-6">Résultat de la recherche</h2>

            <!-- Affichage des résultats -->
            @if(isset($results) && count($results) > 0)
                <p class="text-lg text-gray-100">Votre adresse email a subi une breach sur le(s) site(s) suivant(s) :</p>
                <ul class="mt-4 space-y-4">
                    @foreach($results as $result)
                        <li class="bg-white text-gray-900 border border-gray-200 shadow-md p-4 rounded-lg">
                            <strong>{{ $result['Title'] ?? 'Nom non disponible' }}</strong>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-green-500 text-lg">Bonne nouvelle : votre email n'apparaît pas dans notre base de données.</p>
            @endif

            <!-- Bouton de retour -->
            <div class="flex justify-center mt-6">
                <a href="{{ route('search.email') }}" 
                   class="px-6 py-2 bg-gray-800 text-white font-semibold rounded-lg shadow-md hover:bg-gray-900 transition">
                    Nouvelle recherche
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
