<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Zone;
use App\Models\Sol;
use App\Models\Standing;

class ReferenceDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 2.1 Zones géographiques
        foreach ([
            'grand_lome' => ['nom' => 'Grand Lomé (Lomé, Baguida, Agoè, Adidogomé)', 'coefficient' => 1.00, 'profondeur_forage' => 60, 'prix_foncier_m2' => 50000],
            'maritime' => ['nom' => 'Région Maritime (Tsévié, Aného, Vogan, Kpémé)', 'coefficient' => 1.08, 'profondeur_forage' => 45, 'prix_foncier_m2' => 25000],
            'plateaux' => ['nom' => 'Région des Plateaux (Atakpamé, Kpalimé, Badou)', 'coefficient' => 1.14, 'profondeur_forage' => 70, 'prix_foncier_m2' => 15000],
            'centrale' => ['nom' => 'Région Centrale (Sokodé, Tchamba, Blitta)', 'coefficient' => 1.19, 'profondeur_forage' => 80, 'prix_foncier_m2' => 10000],
            'kara_savanes' => ['nom' => 'Région Kara et Savanes (Kara, Dapaong, Mango)', 'coefficient' => 1.25, 'profondeur_forage' => 90, 'prix_foncier_m2' => 8000],
        ] as $code => $data) {
            Zone::updateOrCreate(['code' => $code], $data);
        }

        // 2.2 Types de sols
        foreach ([
            'ferralitique' => ['nom' => 'Ferralitique', 'coefficient' => 1.00, 'prix_fondation_m2' => 25000],
            'ferrugineux' => ['nom' => 'Ferrugineux tropical', 'coefficient' => 1.10, 'prix_fondation_m2' => 30000],
            'laterite' => ['nom' => 'Latérite / Cuirasse', 'coefficient' => 1.03, 'prix_fondation_m2' => 22000],
            'argileux' => ['nom' => 'Argileux', 'coefficient' => 1.30, 'prix_fondation_m2' => 45000],
            'sableux' => ['nom' => 'Sableux', 'coefficient' => 1.18, 'prix_fondation_m2' => 35000],
            'hydromorphe' => ['nom' => 'Hydromorphe', 'coefficient' => 1.48, 'prix_fondation_m2' => 65000],
            'rocheux' => ['nom' => 'Rocheux', 'coefficient' => 0.98, 'prix_fondation_m2' => 18000],
        ] as $code => $data) {
            Sol::updateOrCreate(['code' => $code], $data);
        }

        // 2.3 Standings Résidentiels
        foreach ([
            'standard' => ['name' => 'Standard', 'description' => 'Fonctionnel et durable — Idéal premier investissement', 'prix_m2_min' => 180000, 'prix_m2_max' => 250000, 'marge' => 0.17, 'emprise_max' => 50, 'hsp' => 2.60, 'terrain_min' => 200, 'niveaux_max' => 1],
            'confort' => ['name' => 'Confort', 'description' => 'Qualité supérieure — Notre cœur de gamme', 'prix_m2_min' => 280000, 'prix_m2_max' => 380000, 'marge' => 0.20, 'emprise_max' => 40, 'hsp' => 2.80, 'terrain_min' => 400, 'niveaux_max' => 1],
            'premium' => ['name' => 'Premium', 'description' => 'Haut de gamme — Piscine incluse, personnalisation poussée', 'prix_m2_min' => 420000, 'prix_m2_max' => 550000, 'marge' => 0.23, 'emprise_max' => 35, 'hsp' => 3.00, 'terrain_min' => 500, 'niveaux_max' => 2],
            'prestige' => ['name' => 'Prestige', 'description' => 'Luxe sur mesure — Matériaux d\'exception, domotique complète', 'prix_m2_min' => 600000, 'prix_m2_max' => 900000, 'marge' => 0.27, 'emprise_max' => 30, 'hsp' => 3.20, 'terrain_min' => 800, 'niveaux_max' => 2],
        ] as $code => $data) {
            Standing::updateOrCreate(['code' => $code], $data);
        }

        // 2.4 Types de bâtiments
        $types = [
            // Résidentiel
            ['secteur' => 'residentiel', 'code' => 'villa', 'nom' => 'Villa individuelle', 'icone' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'description' => 'Construction de plain-pied ou R+1'],
            ['secteur' => 'residentiel', 'code' => 'duplex', 'nom' => 'Duplex / Triplex', 'icone' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'description' => 'Logement sur plusieurs niveaux'],
            ['secteur' => 'residentiel', 'code' => 'immeuble', 'nom' => 'Immeuble résidentiel', 'icone' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'description' => 'Plusieurs appartements (R+2 à R+5)'],
            
            // Tertiaire
            ['secteur' => 'tertiaire', 'code' => 'bureaux', 'nom' => 'Bureaux', 'icone' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'description' => 'Espaces professionnels'],
            ['secteur' => 'tertiaire', 'code' => 'commerce', 'nom' => 'Commerce / Boutiques', 'icone' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z', 'description' => 'Locaux commerciaux'],
            ['secteur' => 'tertiaire', 'code' => 'hotel', 'nom' => 'Hôtel / Résidence', 'icone' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4', 'description' => 'Hébergement hôtelier'],

            // Industriel
            ['secteur' => 'industriel', 'code' => 'entrepot', 'nom' => 'Entrepôt Logistique', 'icone' => 'M19 21V10l-6-3-6 3v11m12 0h-12m12 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-1', 'description' => 'Espace de stockage'],
            ['secteur' => 'industriel', 'code' => 'usine', 'nom' => 'Unité de Production', 'icone' => 'M19 21V10l-6-3-6 3v11m12 0h-12m12 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-1', 'description' => 'Site industriel de production'],

            // Agricole
            ['secteur' => 'agricole', 'code' => 'hangar_agri', 'nom' => 'Hangar Agricole', 'icone' => 'M19 21V10l-6-3-6 3v11m12 0h-12m12 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-1', 'description' => 'Structures métalliques ou maçonnées'],
            ['secteur' => 'agricole', 'code' => 'ferme_avicole', 'nom' => 'Bâtiment d\'élevage', 'icone' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3', 'description' => 'Installations agricoles spécifiques'],
        ];

        foreach ($types as $type) {
            \App\Models\TypeBatiment::updateOrCreate(['code' => $type['code']], $type);
        }
    }
}
