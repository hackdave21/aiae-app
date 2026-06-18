<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\TypeBatiment;
use App\Models\EquipementOption;

class UpdateSimulatorHarmonizationSeeder extends Seeder
{
    public function run(): void
    {
        // 1. UPDATE TYPE BATIMENTS (Renommages et nouveaux prix)
        
        // Renommages
        TypeBatiment::where('code', 'frigo')->update(['code' => 'chambre_froide', 'nom' => 'Chambre froide', 'prix_base_m2' => 450000]);
        TypeBatiment::where('code', 'elevage_volailles')->update(['code' => 'poulailler', 'nom' => 'Poulailler', 'prix_base_m2' => 80000]);
        TypeBatiment::where('code', 'serres')->update(['code' => 'serre', 'nom' => 'Serre', 'prix_base_m2' => 45000]);
        TypeBatiment::where('code', 'stockage')->update(['code' => 'silo', 'nom' => 'Silo de stockage', 'prix_base_m2' => 150000]);
        
        // Mise à jour des prix industriels et agricoles existants
        TypeBatiment::where('code', 'entrepot')->update(['prix_base_m2' => 180000]);
        TypeBatiment::where('code', 'usine')->update(['prix_base_m2' => 250000]);
        TypeBatiment::where('code', 'atelier')->update(['prix_base_m2' => 200000]);
        TypeBatiment::where('code', 'hangar')->update(['prix_base_m2' => 150000]);
        TypeBatiment::where('code', 'elevage_bovins')->update(['prix_base_m2' => 120000]);
        
        // Hangar Agricole
        TypeBatiment::updateOrCreate(
            ['code' => 'hangar_agricole'],
            ['secteur' => 'agricole', 'nom' => 'Hangar agricole', 'icone' => 'Warehouse', 'prix_base_m2' => 100000, 'niveaux_max' => 1, 'description' => 'Structures agricoles']
        );

        // Hôtels étoilés
        $hotels = [
            ['code' => 'hotel_1', 'nom' => 'Hôtel 1 étoile', 'prix_base_m2' => 320000],
            ['code' => 'hotel_2', 'nom' => 'Hôtel 2 étoiles', 'prix_base_m2' => 400000],
            ['code' => 'hotel_3', 'nom' => 'Hôtel 3 étoiles', 'prix_base_m2' => 500000],
            ['code' => 'hotel_4', 'nom' => 'Hôtel 4 étoiles', 'prix_base_m2' => 650000],
            ['code' => 'hotel_5', 'nom' => 'Hôtel 5 étoiles', 'prix_base_m2' => 850000],
        ];

        foreach ($hotels as $hotel) {
            TypeBatiment::updateOrCreate(
                ['code' => $hotel['code']],
                ['secteur' => 'tertiaire', 'nom' => $hotel['nom'], 'icone' => 'Hotel', 'prix_base_m2' => $hotel['prix_base_m2'], 'niveaux_max' => 20, 'description' => 'Hébergement hôtelier']
            );
        }

        // On peut désactiver ou supprimer l'ancien type 'hotel' si on veut être strict, mais on peut aussi le laisser
        // TypeBatiment::where('code', 'hotel')->delete();


        // 2. EQUIPEMENT OPTIONS
        $newOptions = [
            // Industriel
            ['code' => 'quai_chargement', 'categorie' => 'specifique', 'designation' => 'Quai de chargement', 'prix_min' => 3500000, 'unite' => 'U'],
            ['code' => 'porte_sectionnelle', 'categorie' => 'specifique', 'designation' => 'Porte sectionnelle', 'prix_min' => 1800000, 'unite' => 'U'],
            ['code' => 'pont_roulant_5t', 'categorie' => 'specifique', 'designation' => 'Pont roulant 5T', 'prix_min' => 15000000, 'unite' => 'Forf.'],
            ['code' => 'pont_roulant_10t', 'categorie' => 'specifique', 'designation' => 'Pont roulant 10T', 'prix_min' => 25000000, 'unite' => 'Forf.'],
            
            // Agricole
            ['code' => 'irrigation_goutte_a_goutte', 'categorie' => 'exterieur', 'designation' => 'Irrigation Goutte à goutte', 'prix_min' => 1500000, 'unite' => 'ha'],
            ['code' => 'irrigation_aspersion', 'categorie' => 'exterieur', 'designation' => 'Irrigation par Aspersion', 'prix_min' => 2500000, 'unite' => 'ha'],
            ['code' => 'bassin_retention_500', 'categorie' => 'exterieur', 'designation' => 'Bassin de rétention 500m3', 'prix_min' => 8000000, 'unite' => 'Forf.'],
            ['code' => 'bassin_retention_1000', 'categorie' => 'exterieur', 'designation' => 'Bassin de rétention 1000m3', 'prix_min' => 14000000, 'unite' => 'Forf.'],

            // Communs (s'assurer de l'existence/prix)
            ['code' => 'controle_acces_simple', 'categorie' => 'securite', 'designation' => 'Contrôle d\'accès simple (1 porte)', 'prix_min' => 650000, 'unite' => 'Forf.'],
            ['code' => 'controle_acces_complet', 'categorie' => 'securite', 'designation' => 'Contrôle d\'accès complet (4 portes)', 'prix_min' => 2500000, 'unite' => 'Forf.'],

            // Ascenseurs
            ['code' => 'ascenseur_5n', 'categorie' => 'specifique', 'designation' => 'Ascenseur ≤5 niveaux', 'prix_min' => 28000000, 'prix_max' => 35000000, 'unite' => 'U'],
            ['code' => 'ascenseur_10n', 'categorie' => 'specifique', 'designation' => 'Ascenseur 6-10 niveaux', 'prix_min' => 35000000, 'prix_max' => 45000000, 'unite' => 'U'],

            // Parking
            ['code' => 'parking_ext', 'categorie' => 'exterieur', 'designation' => 'Parking extérieur', 'prix_min' => 420000, 'prix_max' => 600000, 'unite' => 'U'],
            ['code' => 'parking_couvert', 'categorie' => 'exterieur', 'designation' => 'Parking couvert', 'prix_min' => 1350000, 'prix_max' => 1800000, 'unite' => 'U'],
            ['code' => 'parking_souterrain', 'categorie' => 'exterieur', 'designation' => 'Parking souterrain', 'prix_min' => 3800000, 'prix_max' => 5000000, 'unite' => 'U'],
        ];

        foreach ($newOptions as $opt) {
            EquipementOption::updateOrCreate(
                ['code' => $opt['code']],
                [
                    'categorie' => $opt['categorie'],
                    'designation' => $opt['designation'],
                    'prix_min' => $opt['prix_min'],
                    'prix_max' => $opt['prix_max'] ?? $opt['prix_min'],
                    'unite' => $opt['unite'],
                    'actif' => true
                ]
            );
        }
        
        // Ensure "groupe_electrogene" base logic check
        EquipementOption::where('categorie', 'groupe')->update(['actif' => true]);
    }
}
