<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Models\Sol;
use App\Models\TypeBatiment;
use App\Models\Standing;
use App\Models\EquipementOption;
use Illuminate\Http\Request;

class SimulatorController extends Controller
{
    public function index()
    {
        $typeBatiments = TypeBatiment::all();
        $standings = Standing::all();
        return view('frontend.simulator', compact('typeBatiments', 'standings'));
    }

    public function simulatorV1(Request $request)
    {
        $secteur = $request->query('secteur', 'residentiel');
        
        // Secteurs (for step 1)
        $secteurs = \App\Models\Sector::all()->map(function($s) {
            return [
                'id' => $s->slug,
                'name' => $s->name,
                'image' => $s->image_url,
                'desc' => $s->description ?? ''
            ];
        });

        // Fetch reference data for the simulator
        $zones = Zone::all()->mapWithKeys(function ($z) {
            return [$z->code => [
                'name' => $z->nom,
                'coef' => $z->coefficient,
                'forage' => $z->profondeur_forage,
                'foncier' => $z->prix_foncier_m2,
                'localites' => 'Principales villes de la zone'
            ]];
        });

        $sols = Sol::all()->mapWithKeys(function ($s) {
            return [$s->code => [
                'name' => $s->nom,
                'coef' => $s->coefficient,
                'prixFond' => $s->prix_fondation_m2,
                'fondation' => $s->description ?? 'À définir',
                'risque' => ($s->coefficient > 1.25) ? 'élevé' : 'faible',
                'portance' => $s->description // or another field if available
            ]];
        });

        $standings = Standing::all()->mapWithKeys(function ($st) {
            return [$st->code => [
                'name' => $st->name,
                'prix' => $st->prix_m2_min,
                'emprise' => ($st->emprise_max / 100),
                'hsp' => $st->hsp,
                'desc' => $st->description ?? "Qualité " . $st->name,
                'icon' => $st->code === 'prestige' ? '🏰' : ($st->code === 'premium' ? '🏘️' : ($st->code === 'confort' ? '🏡' : '🏠'))
            ]];
        });

        $typeBatiments = TypeBatiment::all()->groupBy('secteur')->map(function ($items) {
            return $items->map(function ($t) {
                return [
                    'id' => $t->code,
                    'name' => $t->nom,
                    'icon' => $t->icone,
                    'max' => $t->niveaux_max ?? 5,
                    'prix' => $t->prix_base_m2 ?? 450000,
                    'ratio' => $t->ratio_surface ?? 1
                ];
            });
        });

        $options = EquipementOption::where('actif', true)->get();
        $solaires = $options->where('categorie', 'solaire')->map(function ($o) {
            return [
                'id' => $o->code,
                'kw' => (int) filter_var($o->taille_puissance, FILTER_SANITIZE_NUMBER_INT),
                'prix' => $o->prix_min,
                'designation' => $o->designation
            ];
        })->values();

        $groupes = $options->where('categorie', 'groupe')->map(function ($o) {
            return [
                'id' => $o->code,
                'kva' => (int) filter_var($o->taille_puissance, FILTER_SANITIZE_NUMBER_INT),
                'prix' => $o->prix_min,
                'designation' => $o->designation
            ];
        })->values();

        $simulatorData = [
            'SECTEURS' => $secteurs,
            'ZONES' => $zones,
            'SOLS' => $sols,
            'STANDINGS' => $standings,
            'TYPES' => $typeBatiments,
            'SOLAIRES' => $solaires,
            'GROUPES' => $groupes
        ];

        return view('frontend.simulateur_v1', [
            'secteur' => $secteur,
            'config' => $simulatorData,
            'hideHeaderFooter' => true
        ]);
    }

    public function profile()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        $user = auth()->user();
        $simulations = $user->simulations()->latest()->get();
        
        return view('frontend.profile.index', compact('user', 'simulations'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return back()->with('success', 'Vos informations ont été mises à jour avec succès.');
    }

    public function save(Request $request)
    {
        $data = $request->all();
        $simulationId = $request->input('simulation_id');
        
        if (auth()->check()) {
            if ($simulationId) {
                $simulation = \App\Models\Simulation::where('id', $simulationId)
                    ->where('user_id', auth()->id())
                    ->first();
            }

            if (!isset($simulation) || !$simulation) {
                $simulation = new \App\Models\Simulation();
                $simulation->reference_id = 'SIM-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(3)));
                $simulation->user_id = auth()->id();
                $simulation->status = 'saved';
            }

            $simulation->sector_type_id = 1; 
            $simulation->input_quantity = $data['dimensions']['surface'] ?? 0;
            $simulation->total_amount_ttc = $data['total'] ?? 0;
            $simulation->total_amount_ht = ($data['total'] ?? 0) / 1.18;
            $simulation->base_amount = $data['base_amount'] ?? 0;
            $simulation->options_amount = $data['options_amount'] ?? 0;
            
            $simulation->configuration_data = $data;
            $simulation->save();
            
            return response()->json([
                'status' => 'success', 
                'simulation_id' => $simulation->id,
                'redirect' => route('profile')
            ]);
        } else {
            session(['pending_simulation' => $data]);
            return response()->json(['status' => 'guest', 'redirect' => route('register')]);
        }
    }

    public function show($id)
    {
        $simulation = auth()->user()->simulations()->findOrFail($id);
        $config = $simulation->configuration_data;
        
        // Enrich with designations
        $optionCodes = collect($config['options'] ?? [])->filter()->values()->toArray();
        $optionLabels = \App\Models\EquipementOption::whereIn('code', $optionCodes)->pluck('designation', 'code')->toArray();

        $secteurLabels = [
            'residentiel' => 'Résidentiel', 
            'tertiaire' => 'Tertiaire / Services', 
            'industriel' => 'Industriel', 
            'agricole' => 'Agricole'
        ];
        $typeLabels = [
            'villa' => 'Villa individuelle', 
            'immeuble' => 'Immeuble résidentiel', 
            'residence' => 'Résidence de standing',
            'bureaux' => 'Bureaux', 
            'commerce' => 'Commerce', 
            'hotel' => 'Hôtel', 
            'clinique' => 'Clinique',
            'entrepot' => 'Entrepôt', 
            'usine' => 'Usine', 
            'atelier' => 'Atelier', 
            'frigo' => 'Chambre froide',
            'hangar' => 'Hangar', 
            'elevage_bovins' => 'Élevage bovins', 
            'elevage_volailles' => 'Élevage volailles', 
            'serres' => 'Serres', 
            'stockage' => 'Silos Agricoles',
            'culture_vivriere' => 'Culture vivrière',
            'transformation' => 'Unité de transformation'
        ];
        
        $zoneLabels = [
            'zone1' => 'Zone 1 – Grand Lomé',
            'zone2' => 'Zone 2 – Maritime',
            'zone3' => 'Zone 3 – Plateaux',
            'zone4' => 'Zone 4 – Centrale',
            'zone5' => 'Zone 5 – Kara & Savanes'
        ];
        
        $solLabels = [
            'inconnu' => 'Non déterminé',
            'ferralitique' => 'Ferralitique (Terre de barre)',
            'ferrugineux' => 'Ferrugineux tropical',
            'laterite' => 'Latérite / Cuirasse',
            'argileux' => 'Argileux',
            'sableux' => 'Sableux',
            'hydromorphe' => 'Hydromorphe',
            'rocheux' => 'Rocheux'
        ];
        
        return view('frontend.profile.simulation_details', compact('simulation', 'config', 'optionLabels', 'secteurLabels', 'typeLabels', 'zoneLabels', 'solLabels'));
    }

    public function results(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('message', 'Veuillez vous connecter pour voir les résultats de votre simulation.');
        }

        // Logic to process and display simulation results
        return view('frontend.simulation-results');
    }
}
