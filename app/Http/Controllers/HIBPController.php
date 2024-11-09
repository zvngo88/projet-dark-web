<?php
namespace App\Http\Controllers;

use App\Services\HIBPService;
use Illuminate\Http\Request;

class HIBPController extends Controller
{
    protected $hibpService;

    public function __construct(HIBPService $hibpService)
    {
        $this->hibpService = $hibpService;
    }

    /**
     * Affiche la page de recherche d'email.
     */
    public function showEmailSearch(Request $request)
    {
        $results = null; // Par défaut, pas de résultats

        if ($request->isMethod('post')) {
            $request->validate(['email' => 'required|email']);
            $email = $request->input('email');

            // Appel du service pour rechercher les breaches
            $results = $this->hibpService->searchEmail($email);
        }

        // Passer les résultats à la vue
        return view('hibp.results_email', [
            'results' => $results,
            'query' => $request->input('email', null), // Optionnel
        ]);
    }

    /**
     * Effectue une recherche par email et retourne les résultats.
     */
    public function searchEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $email = $request->input('email');
    
        // Appel du service pour rechercher les breaches
        $results = $this->hibpService->searchEmail($email);
    
        // Vérifier si des résultats existent
        if (empty($results)) {
            $message = "Bonne nouvelle : votre email n'apparaît pas dans notre base de données.";
        } else {
            $message = "Votre adresse email a subi une breach sur le(s) site(s) suivant(s) : " . implode(', ', $results);
        }
    
        // Passer les résultats et le message à la vue
        return view('hibp.results_email', [
            'message' => $message,
            'query' => $email,
        ]);
    }

    
}
