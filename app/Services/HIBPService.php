<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class HIBPService
{
    protected $baseUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->baseUrl = config('services.hibp.base_url');
        $this->apiKey = config('services.hibp.key');
    }

    public function searchEmail($email)
    {
        $response = Http::withHeaders([
            'hibp-api-key' => $this->apiKey,
            'User-Agent' => 'YourAppName', // Changez par le nom de votre application
        ])->timeout(30)
          ->get("{$this->baseUrl}/breachedaccount/{$email}", [
              'truncateResponse' => false,
          ]);
    
        if ($response->successful()) {
            $results = $response->json();
    
            // Extraire uniquement les noms des sites avec des violations
            return array_map(function ($result) {
                return $result['Name'] ?? 'Nom non disponible';
            }, $results);
        }
    
        // En cas d'erreur ou de données introuvables
        return [];
    }
}
