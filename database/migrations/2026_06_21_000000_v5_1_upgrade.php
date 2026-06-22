<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('standings', function (Blueprint $table) {
            $table->text('description')->nullable()->after('code');
            $table->decimal('emprise_recommandee', 4, 2)->nullable()->after('emprise_max');
            $table->decimal('emprise_min', 4, 2)->nullable()->after('emprise_recommandee');
            $table->decimal('hsp_rdc', 4, 2)->nullable()->after('hsp');
            $table->decimal('hsp_etage', 4, 2)->nullable()->after('hsp_rdc');
            $table->decimal('hsp_soussol', 4, 2)->nullable()->after('hsp_etage');
        });

        Schema::table('simulations', function (Blueprint $table) {
            $table->decimal('hsp_rdc', 4, 2)->nullable()->after('input_quantity');
            $table->decimal('hsp_etage', 4, 2)->nullable()->after('hsp_rdc');
            $table->decimal('hsp_soussol', 4, 2)->nullable()->after('hsp_etage');
        });

        DB::table('equipement_options')
            ->where('code', 'solaire_5kwc')
            ->update(['prix_min' => 4500000, 'prix_max' => 6500000]);

        DB::table('standings')
            ->where('code', 'standard')
            ->update([
                'description' => 'Matériaux standards, agglos pleins, chaînages verticaux conformes DTU',
                'emprise_recommandee' => 0.40,
                'emprise_min' => 0.35,
                'hsp_rdc' => 2.80,
                'hsp_etage' => 2.60,
                'hsp_soussol' => 2.40,
            ]);

        DB::table('standings')
            ->where('code', 'confort')
            ->update([
                'description' => 'Matériaux de qualité, poteaux/chaînages renforcés, isolation thermique naturelle',
                'emprise_recommandee' => 0.35,
                'emprise_min' => 0.30,
                'hsp_rdc' => 3.00,
                'hsp_etage' => 2.80,
                'hsp_soussol' => 2.50,
            ]);

        DB::table('standings')
            ->where('code', 'premium')
            ->update([
                'description' => 'Matériaux haut de gamme, structure optimisée, performances thermiques supérieures',
                'emprise_recommandee' => 0.30,
                'emprise_min' => 0.25,
                'hsp_rdc' => 3.20,
                'hsp_etage' => 3.00,
                'hsp_soussol' => 2.60,
            ]);

        DB::table('standings')
            ->where('code', 'prestige')
            ->update([
                'description' => 'Matériaux nobles, structure personnalisée, prestations exclusives sur mesure',
                'emprise_recommandee' => 0.30,
                'emprise_min' => 0.25,
                'hsp_rdc' => 3.50,
                'hsp_etage' => 3.20,
                'hsp_soussol' => 2.80,
            ]);
    }

    public function down(): void
    {
        Schema::table('standings', function (Blueprint $table) {
            $table->dropColumn(['description', 'emprise_recommandee', 'emprise_min', 'hsp_rdc', 'hsp_etage', 'hsp_soussol']);
        });

        Schema::table('simulations', function (Blueprint $table) {
            $table->dropColumn(['hsp_rdc', 'hsp_etage', 'hsp_soussol']);
        });

        DB::table('equipement_options')
            ->where('code', 'solaire_5kwc')
            ->update(['prix_min' => 7500000, 'prix_max' => 9500000]);
    }
};
