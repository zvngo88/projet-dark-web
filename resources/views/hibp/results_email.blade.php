@extends('layouts.dashboard')

@section('title', 'Recherche Email')

@section('content')
<div class="bg-gradient-to-r from-blue-600 to-blue-400 text-white py-24 text-center">
    <h1 class="text-6xl font-bold border-white border-4 p-4 inline-block rounded-lg">(• ᴧ •) Wuluni?</h1>
    <p class="text-xl mt-4">Check if your email is in a data breach</p>
</div>

<div class="py-12 bg-gradient-to-b from-blue-500 to-blue-300">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="text-center">
            <!-- Formulaire de recherche -->
            <h2 class="text-3xl font-bold text-white mb-6">Rechercher une adresse email</h2>
            <form method="POST" action="{{ route('search.email') }}" class="flex justify-center items-center bg-white rounded-full shadow-lg">
                @csrf
                <input 
                    type="email" 
                    name="email" 
                    placeholder="Entrez votre email" 
                    class="w-full py-4 px-6 text-lg text-gray-900 rounded-l-full focus:outline-none focus:ring-2 focus:ring-indigo-500 placeholder-gray-500" 
                    required>
                <button 
                    type="submit" 
                    class="bg-gray-700 text-white px-8 py-4 rounded-r-full hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    Rechercher
                </button>
            </form>

            <!-- Résultats de recherche -->
            @if($results !== null)
                <div class="mt-10">
                    <h2 class="text-3xl font-bold text-white mb-6">Résultat de la recherche</h2>
                    @if(count($results) > 0)
                        <p class="text-lg text-gray-100">Votre adresse email a subi une breach sur le(s) site(s) suivant(s) :</p>
                        <ul class="mt-4 space-y-4">
                            @foreach($results as $site)
                                <li class="bg-white text-gray-900 border border-gray-200 shadow-md p-4 rounded-lg">
                                    <strong>{{ $site }}</strong>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-green-500 text-lg">Bonne nouvelle : votre email n'apparaît pas dans notre base de données.</p>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
