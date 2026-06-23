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
                'prix_max' => $st->prix_m2_max,
                'emprise' => ($st->emprise_max / 100),
                'emprise_recommandee' => $st->emprise_recommandee ?? 0.35,
                'emprise_min' => $st->emprise_min ?? 0.25,
                'hsp' => $st->hsp,
                'hsp_rdc' => $st->hsp_rdc ?? 3.0,
                'hsp_etage' => $st->hsp_etage ?? 2.8,
                'hsp_soussol' => $st->hsp_soussol ?? 2.5,
                'marge' => $st->marge ?? 0.20,
                'desc' => $st->description ?? "Qualité " . $st->name,
                'icon' => $st->code === 'prestige' ? 'Crown' : ($st->code === 'premium' ? 'Gem' : ($st->code === 'confort' ? 'Armchair' : 'Home'))
            ]];
        });

        $typeBatiments = TypeBatiment::all()->groupBy('secteur')->map(function ($items) {
            return $items->map(function ($t) {
                // Mapping icônes types
                $icons = [
                    'villa' => 'Home', 'immeuble' => 'Building2', 'residence' => 'Building',
                    'bureaux' => 'Briefcase', 'commerce' => 'Store', 'hotel_1' => 'Hotel', 'hotel_2' => 'Hotel', 'hotel_3' => 'Hotel', 'hotel_4' => 'Hotel', 'hotel_5' => 'Hotel', 'clinique' => 'Hospital',
                    'entrepot' => 'Box', 'usine' => 'Factory', 'atelier' => 'Wrench', 'chambre_froide' => 'Snowflake',
                    'hangar' => 'Warehouse', 'hangar_agricole' => 'Warehouse', 'elevage_bovins' => 'Beef', 'poulailler' => 'Bird', 'serre' => 'Sprout', 'silo' => 'Wheat'
                ];
                return [
                    'id' => $t->code,
                    'name' => $t->nom,
                    'icon' => $icons[$t->code] ?? 'Building',
                    'max' => $t->niveaux_max ?? 5,
                    'prix' => $t->prix_base_m2 ?? 450000,
                    'ratio' => $t->ratio_surface ?? 1
                ];
            })->reject(function ($item) {
                return in_array($item['id'], ['hangar', 'hangar_agri']);
            })->values();
        });

        $options = EquipementOption::where('actif', true)->get();
        
        $solaires = $options->where('categorie', 'solaire')->map(function ($o) {
            $valStr = $o->taille_puissance ?: ($o->puissance ?: $o->designation);
            return [
                'id' => $o->code,
                'kw' => (int) filter_var($valStr, FILTER_SANITIZE_NUMBER_INT),
                'prix' => $o->prix_min,
                'prix_max' => $o->prix_max,
                'designation' => $o->designation
            ];
        })->values();

        $groupes = $options->where('categorie', 'groupe')->map(function ($o) {
            $valStr = $o->taille_puissance ?: ($o->puissance ?: $o->designation);
            return [
                'id' => $o->code,
                'kva' => (int) filter_var($valStr, FILTER_SANITIZE_NUMBER_INT),
                'prix' => $o->prix_min,
                'prix_max' => $o->prix_max,
                'designation' => $o->designation
            ];
        })->values();

        $mapOption = function ($o) {
            return [
                'id' => $o->code,
                'name' => $o->designation,
                'prix' => $o->prix_min,
                'prix_max' => $o->prix_max,
                'unite' => $o->unite ?? 'U',
                'mapping' => $o->mapping_standings ?: new \stdClass()
            ];
        };

        $securite = $options->where('categorie', 'securite')->map($mapOption)->values();
        $exterieur = $options->where('categorie', 'exterieur')->map($mapOption)->values();
        $domotique = $options->where('categorie', 'domotique')->map($mapOption)->values();
        $secondOeuvre = $options->where('categorie', 'second_oeuvre')->map($mapOption)->values();
        $specifique = $options->where('categorie', 'specifique')->map($mapOption)->values();

        $simulatorData = [
            'SECTEURS' => $secteurs,
            'ZONES' => $zones,
            'SOLS' => $sols,
            'STANDINGS' => $standings,
            'TYPES' => $typeBatiments,
            'SOLAIRES' => $solaires,
            'GROUPES' => $groupes,
            'SECURITE' => $securite,
            'EXTERIEUR' => $exterieur,
            'DOMOTIQUE' => $domotique,
            'SECONDE_OEUVRE' => $secondOeuvre,
            'SPECIFIQUE' => $specifique,
            'PARAMS' => [
                'sous_sol_prix' => 85000,
                'vrd_base_prix' => 8500,
                'forage_prix_m' => 95000,
                'forage_fixe' => 1200000,
                'cloture_prix_bas' => 88000,
                'cloture_prix_haut' => 135000,
            ]
        ];

        $quickStartConfig = [
            'secteur' => $request->query('secteur', 'residentiel'),
            'mode' => $request->query('mode', 'express'),
            'surface' => $request->query('surface'),
            'surface_terrain' => $request->query('surface_terrain'),
            'standing' => $request->query('standing'),
            'espaces_communs' => $request->query('espaces_communs'),
            'nb_baths' => $request->query('nb_baths'),
            'nb_beds' => $request->query('nb_beds'),
            'options' => $request->query('options') ? explode(',', $request->query('options')) : []
        ];

        return view('frontend.simulateur_v1', [
            'secteur' => $secteur,
            'config' => $simulatorData,
            'quickStart' => $quickStartConfig,
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

            // Synchroniser les options dans la table simulation_options (pour l'admin)
            if (isset($data['options']) && is_array($data['options'])) {
                $simulation->simulationOptions()->delete();
                $optionCodes = collect($data['options'])->filter()->values()->toArray();
                $dbOptions = \App\Models\EquipementOption::whereIn('code', $optionCodes)->get();
                
                foreach ($dbOptions as $dbOpt) {
                    $simulation->simulationOptions()->create([
                        'equipement_option_id' => $dbOpt->id,
                        'designation' => $dbOpt->designation,
                        'code' => $dbOpt->code,
                        'categorie' => $dbOpt->categorie,
                        'prix_unitaire' => $dbOpt->prix_min,
                        'quantite' => 1,
                        'subtotal' => $dbOpt->prix_min
                    ]);
                }
            }
            
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
            'hotel_1' => 'Hôtel 1 étoile', 
            'hotel_2' => 'Hôtel 2 étoiles', 
            'hotel_3' => 'Hôtel 3 étoiles', 
            'hotel_4' => 'Hôtel 4 étoiles', 
            'hotel_5' => 'Hôtel 5 étoiles', 
            'clinique' => 'Clinique',
            'entrepot' => 'Entrepôt', 
            'usine' => 'Usine', 
            'atelier' => 'Atelier', 
            'chambre_froide' => 'Chambre froide',
            'hangar' => 'Hangar', 
            'elevage_bovins' => 'Élevage bovins', 
            'poulailler' => 'Poulailler', 
            'serre' => 'Serres', 
            'silo' => 'Silos Agricoles',
            'hangar_agricole' => 'Hangar agricole',
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

    public function pdf(Request $request)
    {
        $config = $request->all();
        $ref = 'SIM-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(6));
        return view('frontend.simulation_pdf', compact('config', 'ref'));
    }
}
