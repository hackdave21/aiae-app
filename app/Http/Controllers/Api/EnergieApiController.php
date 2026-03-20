<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CalculateurEnergieSecuriseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnergieApiController extends Controller
{
    protected $secureService;

    public function __construct(CalculateurEnergieSecuriseService $secureService)
    {
        $this->secureService = $secureService;
    }

    /**
     * Calcule l'estimation solaire / hybride
     */
    public function calculer(Request $request)
    {
        $request->validate([
            'inventaire' => 'required|array',
            'inventaire.*.code' => 'required|string|exists:equipements_energie,code',
            'inventaire.*.qty' => 'required|integer|min:1',
            'zone' => 'required|string|exists:zones_irradiation,zone_code',
            'mode' => 'required|string|in:solaire,groupe,hybride'
        ]);

        try {
            $resultats = $this->secureService->genererEstimation($request->all());
            return response()->json([
                'status' => 'success',
                'data' => $resultats
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue lors du calcul.'
            ], 500);
        }
    }

    /**
     * Calcule l'estimation biogaz
     */
    public function calculerBiogaz(Request $request)
    {
        $request->validate([
            'cheptel' => 'required|array',
            'cheptel.*.code' => 'required|string|exists:cheptel_biogaz,code',
            'cheptel.*.nombre' => 'required|integer|min:0',
            'collecte' => 'required|string|exists:taux_collecte,code'
        ]);

        try {
            $resultats = $this->secureService->genererEstimationBiogaz(
                $request->input('cheptel'),
                $request->input('collecte')
            );
            return response()->json([
                'status' => 'success',
                'data' => $resultats
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors du calcul biogaz.'
            ], 500);
        }
    }

    /**
     * Récupère la liste des équipements disponibles
     */
    public function getEquipements(Request $request)
    {
        $categorie = $request->query('categorie');
        $query = DB::table('equipements_energie')->where('actif', true);
        
        if ($categorie) {
            $query->where('categorie', $categorie);
        }

        return response()->json($query->orderBy('ordre_affichage')->get());
    }

    /**
     * Récupère les zones et leurs HSP
     */
    public function getZones()
    {
        return response()->json(DB::table('zones_irradiation')->get());
    }

    /**
     * Enregistre une estimation et génère un lead
     */
    public function saveEstimation(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'telephone' => 'required|string',
            'nom' => 'nullable|string',
            'resultats' => 'required|array',
            'details_techniques' => 'nullable|array'
        ]);

        try {
            DB::beginTransaction();

            $code = 'EST-EN-' . strtoupper(substr(uniqid(), -6));
            
            DB::table('estimations_energie')->insert([
                'code_estimation' => $code,
                'email' => $request->email,
                'telephone' => $request->telephone,
                'resultats_json' => json_encode($request->resultats),
                'bilan_puissance_json' => json_encode($request->details_techniques),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('leads')->insert([
                'first_name' => $request->nom ?? 'Client',
                'last_name' => 'Energie',
                'email' => $request->email,
                'phone' => $request->telephone,
                'source' => 'Calculateur Energie',
                'status' => 'new',
                'notes' => 'Demande de devis issue du calculateur d\'énergie: ' . $code,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'reference' => $code,
                'message' => 'Votre demande de devis a été enregistrée avec succès. Un conseiller vous contactera sous peu.'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => 'Erreur lors de l\'enregistrement de votre demande.'
            ], 500);
        }
    }
}
