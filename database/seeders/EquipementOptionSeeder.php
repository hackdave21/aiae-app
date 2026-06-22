<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EquipementOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = [
            // Solaire (Mapping included)
            ['code' => 'solaire_3kwc', 'categorie' => 'solaire', 'designation' => 'Kit solaire hybride 3 kWc', 'prix_min' => 4500000, 'prix_max' => 5500000, 'puissance' => '3 kWc', 'unite' => 'Forf.', 'mapping_standings' => ['standard' => 'opt', 'confort' => 'opt']],
            ['code' => 'solaire_5kwc', 'categorie' => 'solaire', 'designation' => 'Kit solaire hybride 5 kWc', 'prix_min' => 4500000, 'prix_max' => 6500000, 'puissance' => '5 kWc', 'unite' => 'Forf.', 'mapping_standings' => ['confort' => 'recom', 'premium' => 'opt']],
            ['code' => 'solaire_10kwc', 'categorie' => 'solaire', 'designation' => 'Kit solaire hybride 10 kWc', 'prix_min' => 14000000, 'prix_max' => 18000000, 'puissance' => '10 kWc', 'unite' => 'Forf.', 'mapping_standings' => ['premium' => 'recom', 'prestige' => 'opt']],
            ['code' => 'solaire_15kwc', 'categorie' => 'solaire', 'designation' => 'Kit solaire hybride 15 kWc', 'prix_min' => 20000000, 'prix_max' => 26000000, 'puissance' => '15 kWc', 'unite' => 'Forf.', 'mapping_standings' => ['prestige' => 'preselect']],
            ['code' => 'solaire_20kwc', 'categorie' => 'solaire', 'designation' => 'Kit solaire hybride 20 kWc', 'prix_min' => 26000000, 'prix_max' => 33000000, 'puissance' => '20 kWc', 'unite' => 'Forf.'],
            ['code' => 'solaire_30kwc', 'categorie' => 'solaire', 'designation' => 'Kit solaire hybride 30 kWc', 'prix_min' => 38000000, 'prix_max' => 48000000, 'puissance' => '30 kWc', 'unite' => 'Forf.'],
            ['code' => 'solaire_50kwc', 'categorie' => 'solaire', 'designation' => 'Kit solaire hybride 50 kWc', 'prix_min' => 58000000, 'prix_max' => 75000000, 'puissance' => '50 kWc', 'unite' => 'Forf.'],
            ['code' => 'solaire_100kwc', 'categorie' => 'solaire', 'designation' => 'Kit solaire hybride 100 kWc', 'prix_min' => 105000000, 'prix_max' => 135000000, 'puissance' => '100 kWc', 'unite' => 'Forf.'],

            // Sécurité - Alarme
            ['code' => 'alarme_basique', 'categorie' => 'securite', 'designation' => 'Alarme basique (4 détecteurs)', 'prix_min' => 350000, 'prix_max' => 500000, 'unite' => 'Forf.', 'mapping_standings' => ['confort' => 'opt', 'premium' => 'opt']],
            ['code' => 'alarme_avancee', 'categorie' => 'securite', 'designation' => 'Alarme avancée (6 détect. + GSM)', 'prix_min' => 600000, 'prix_max' => 850000, 'unite' => 'Forf.', 'mapping_standings' => ['premium' => 'preselect', 'prestige' => 'opt']],
            ['code' => 'alarme_complete', 'categorie' => 'securite', 'designation' => 'Alarme complète connectée', 'prix_min' => 900000, 'prix_max' => 1400000, 'unite' => 'Forf.', 'mapping_standings' => ['prestige' => 'preselect']],

            // Vidéosurveillance
            ['code' => 'video_4cam', 'categorie' => 'securite', 'designation' => 'Vidéosurveillance 4 caméras HD', 'prix_min' => 500000, 'prix_max' => 850000, 'unite' => 'Forf.', 'mapping_standings' => ['confort' => 'opt']],
            ['code' => 'video_8cam', 'categorie' => 'securite', 'designation' => 'Vidéosurveillance 8 caméras HD', 'prix_min' => 1000000, 'prix_max' => 1500000, 'unite' => 'Forf.', 'mapping_standings' => ['premium' => 'opt', 'prestige' => 'preselect']],
            ['code' => 'video_16cam', 'categorie' => 'securite', 'designation' => 'Vidéosurveillance 16 caméras HD', 'prix_min' => 2000000, 'prix_max' => 2800000, 'unite' => 'Forf.'],

            // Clôtures
            ['code' => 'cloture_prefab', 'categorie' => 'exterieur', 'designation' => 'Clôture panneaux préfab. H=2m', 'prix_min' => 50000, 'prix_max' => 70000, 'unite' => 'ml'],
            ['code' => 'cloture_agglos', 'categorie' => 'exterieur', 'designation' => 'Clôture agglos crépi H=2m', 'prix_min' => 65000, 'prix_max' => 90000, 'unite' => 'ml', 'mapping_standings' => ['standard' => 'preselect', 'confort' => 'preselect']],
            ['code' => 'cloture_mixte', 'categorie' => 'exterieur', 'designation' => 'Clôture mixte agglos+grille H=2m', 'prix_min' => 75000, 'prix_max' => 100000, 'unite' => 'ml', 'mapping_standings' => ['premium' => 'preselect']],
            ['code' => 'cloture_hg', 'categorie' => 'exterieur', 'designation' => 'Clôture haut de gamme H=2m', 'prix_min' => 110000, 'prix_max' => 150000, 'unite' => 'ml', 'mapping_standings' => ['prestige' => 'preselect']],

            // Portails
            ['code' => 'portillon', 'categorie' => 'exterieur', 'designation' => 'Portillon piéton 1m', 'prix_min' => 130000, 'prix_max' => 200000, 'unite' => 'U'],
            ['code' => 'portail_simple', 'categorie' => 'exterieur', 'designation' => 'Portail métallique simple 3m', 'prix_min' => 350000, 'prix_max' => 500000, 'unite' => 'U', 'mapping_standings' => ['standard' => 'preselect']],
            ['code' => 'portail_double', 'categorie' => 'exterieur', 'designation' => 'Portail métallique double 5m', 'prix_min' => 600000, 'prix_max' => 800000, 'unite' => 'U', 'mapping_standings' => ['confort' => 'preselect']],
            ['code' => 'portail_motorise', 'categorie' => 'exterieur', 'designation' => 'Portail coulissant motorisé 5m', 'prix_min' => 1200000, 'prix_max' => 1600000, 'unite' => 'U', 'mapping_standings' => ['premium' => 'preselect', 'prestige' => 'preselect']],

            // Forage (mapping correct)
            ['code' => 'forage_30m', 'categorie' => 'exterieur', 'designation' => 'Forage équipé 30m', 'prix_min' => 2500000, 'prix_max' => 3500000, 'unite' => 'Forf.', 'mapping_standings' => ['standard' => 'opt', 'confort' => 'opt']],
            ['code' => 'forage_60m', 'categorie' => 'exterieur', 'designation' => 'Forage équipé 60m', 'prix_min' => 4000000, 'prix_max' => 5800000, 'unite' => 'Forf.', 'mapping_standings' => ['premium' => 'recom', 'prestige' => 'recom']],
            
            // Piscines
            ['code' => 'piscine_6x3', 'categorie' => 'exterieur', 'designation' => 'Piscine béton carrelée 6×3m', 'prix_min' => 6000000, 'prix_max' => 9000000, 'unite' => 'Forf.', 'mapping_standings' => ['confort' => 'opt']],
            ['code' => 'piscine_8x4', 'categorie' => 'exterieur', 'designation' => 'Piscine béton carrelée 8×4m', 'prix_min' => 9500000, 'prix_max' => 13000000, 'unite' => 'Forf.', 'mapping_standings' => ['premium' => 'recom']],
            ['code' => 'piscine_10x5', 'categorie' => 'exterieur', 'designation' => 'Piscine béton carrelée 10×5m', 'prix_min' => 14000000, 'prix_max' => 19000000, 'unite' => 'Forf.', 'mapping_standings' => ['prestige' => 'preselect']],
            ['code' => 'piscine_12x5', 'categorie' => 'exterieur', 'designation' => 'Piscine à débordement 12×5m', 'prix_min' => 22000000, 'prix_max' => 30000000, 'unite' => 'Forf.'],
            ['code' => 'piscine_plage', 'categorie' => 'exterieur', 'designation' => 'Piscine plage immergée 8×4m', 'prix_min' => 16000000, 'prix_max' => 22000000, 'unite' => 'Forf.'],

            // 5.1 Domotique (Tableau 5 - V5)
            ['code' => 'domotique_basique', 'categorie' => 'domotique', 'designation' => 'Éclairage connecté', 'prix_min' => 400000, 'prix_max' => 700000, 'unite' => 'Forf.', 'mapping_standings' => ['confort' => 'opt']],
            ['code' => 'domotique_partielle', 'categorie' => 'domotique', 'designation' => 'Domotique partielle', 'prix_min' => 1200000, 'prix_max' => 2000000, 'unite' => 'Forf.', 'mapping_standings' => ['premium' => 'opt']],
            ['code' => 'domotique_complete', 'categorie' => 'domotique', 'designation' => 'Maison intelligente', 'prix_min' => 3000000, 'prix_max' => 5500000, 'unite' => 'Forf.', 'mapping_standings' => ['prestige' => 'opt']],

            // 5.2 Aménagement Paysager (Tableau 6 - V5)
            ['code' => 'paysager_basique', 'categorie' => 'exterieur', 'designation' => 'Gazon + arbres (~200m²)', 'prix_min' => 1500000, 'prix_max' => 3000000, 'unite' => 'Forf.', 'mapping_standings' => ['confort' => 'opt']],
            ['code' => 'paysager_soigne', 'categorie' => 'exterieur', 'designation' => 'Jardin soigné (~300m²)', 'prix_min' => 3000000, 'prix_max' => 5500000, 'unite' => 'Forf.', 'mapping_standings' => ['premium' => 'opt']],
            ['code' => 'paysager_prestige', 'categorie' => 'exterieur', 'designation' => 'Design paysager (~500m²)', 'prix_min' => 6000000, 'prix_max' => 12000000, 'unite' => 'Forf.', 'mapping_standings' => ['prestige' => 'opt']],

            // 5.3 Volets Roulants (Tableau 7 - V5)
            ['code' => 'volet_manuel', 'categorie' => 'second_oeuvre', 'designation' => 'PVC manuel', 'prix_min' => 35000, 'prix_max' => 50000, 'unite' => 'm²', 'mapping_standings' => ['confort' => 'opt']],
            ['code' => 'volet_motorise', 'categorie' => 'second_oeuvre', 'designation' => 'Alu motorisé', 'prix_min' => 55000, 'prix_max' => 80000, 'unite' => 'm²', 'mapping_standings' => ['premium' => 'opt']],
            ['code' => 'volet_centralise', 'categorie' => 'second_oeuvre', 'designation' => 'Alu centralisé', 'prix_min' => 70000, 'prix_max' => 100000, 'unite' => 'm²'],
            ['code' => 'volet_connecte', 'categorie' => 'second_oeuvre', 'designation' => 'Alu connecté', 'prix_min' => 85000, 'prix_max' => 120000, 'unite' => 'm²', 'mapping_standings' => ['prestige' => 'opt']],

            // 5.4 Citerne Eau de Pluie (Tableau 8 - V5)
            ['code' => 'citerne_5m3', 'categorie' => 'exterieur', 'designation' => 'Citerne 5 000L', 'prix_min' => 800000, 'prix_max' => 1200000, 'unite' => 'Forf.', 'mapping_standings' => ['standard' => 'opt', 'confort' => 'opt']],
            ['code' => 'citerne_10m3', 'categorie' => 'exterieur', 'designation' => 'Citerne 10 000L', 'prix_min' => 1400000, 'prix_max' => 2000000, 'unite' => 'Forf.', 'mapping_standings' => ['premium' => 'recom']],
            ['code' => 'citerne_20m3', 'categorie' => 'exterieur', 'designation' => 'Citerne 20 000L', 'prix_min' => 2500000, 'prix_max' => 3500000, 'unite' => 'Forf.', 'mapping_standings' => ['prestige' => 'recom']],

            // Groupes Électrogènes
            ['code' => 'groupe_15kva', 'categorie' => 'groupe', 'designation' => 'Groupe électrogène 15 kVA', 'prix_min' => 4500000, 'prix_max' => 6000000, 'unite' => 'U'],
            ['code' => 'groupe_20kva', 'categorie' => 'groupe', 'designation' => 'Groupe électrogène 20 kVA', 'prix_min' => 5500000, 'prix_max' => 7500000, 'unite' => 'U'],
            ['code' => 'groupe_40kva', 'categorie' => 'groupe', 'designation' => 'Groupe électrogène 40 kVA', 'prix_min' => 9000000, 'prix_max' => 12000000, 'unite' => 'U'],
            ['code' => 'groupe_60kva', 'categorie' => 'groupe', 'designation' => 'Groupe électrogène 60 kVA', 'prix_min' => 14000000, 'prix_max' => 18000000, 'unite' => 'U'],
            ['code' => 'groupe_100kva', 'categorie' => 'groupe', 'designation' => 'Groupe électrogène 100 kVA', 'prix_min' => 22000000, 'prix_max' => 28000000, 'unite' => 'U'],
            ['code' => 'groupe_150kva', 'categorie' => 'groupe', 'designation' => 'Groupe électrogène 150 kVA', 'prix_min' => 32000000, 'prix_max' => 42000000, 'unite' => 'U'],
        ];

        foreach ($options as $option) {
            \App\Models\EquipementOption::updateOrCreate(['code' => $option['code']], $option);
        }
    }
}
