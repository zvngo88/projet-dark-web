<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteCrawler; // Assurez-vous d'avoir créé ce modèle
use App\Models\SiteCrawler2;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        // Valider la requête pour interdire les caractères spéciaux
        $request->validate([
            'query' => ['required', 'regex:/^[a-zA-Z0-9\s]+$/']
        ], [
            'query.regex' => 'La recherche ne doit contenir que des lettres, chiffres et espaces.',
        ]);

        $query = $request->input('query');

        // Requête de recherche dans la première table
        $results1 = SiteCrawler::where('name', 'LIKE', '%' . $query . '%')
            ->orderBy('name')
            ->get();

        // Requête de recherche dans la deuxième table
        $results2 = SiteCrawler2::where('name', 'LIKE', '%' . $query . '%')
            ->orderBy('name')
            ->get();

        // Fusionner les deux collections
        $mergedResults = $results1->merge($results2);

        // Regrouper manuellement par 'name' après la fusion
        $groupedResults = $mergedResults->groupBy('name');

        // Retourne les résultats au dashboard
        return view('dashboard', ['results' => $groupedResults]);
    }

}
