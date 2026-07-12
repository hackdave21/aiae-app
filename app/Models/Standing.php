<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Standing extends Model
{
    protected $fillable = [
        'name', 'code', 'description', 'prix_m2_min', 'prix_m2_max', 'emprise_max', 'emprise_recommandee', 'emprise_min', 'hsp', 'hsp_rdc', 'hsp_etage', 'hsp_soussol', 'terrain_min', 'niveaux_max', 'marge'
    ];

    protected function casts(): array
    {
        return [
            'emprise_recommandee' => 'float',
            'emprise_min' => 'float',
            'hsp_rdc' => 'float',
            'hsp_etage' => 'float',
            'hsp_soussol' => 'float',
            'marge' => 'float',
        ];
    }
}
