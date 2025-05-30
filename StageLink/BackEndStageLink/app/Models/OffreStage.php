<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OffreStage extends Model
{
    use HasFactory;

    protected $table = 'offres_stage';
    protected $primaryKey = 'id_offre_stage';

    protected $fillable = [
        'id_entreprise',
        'titre',
        'description',
        'exigences',
        'duree',
        'date_debut',
        'date_fin',
        'localisation',
        'remuneration',
        'secteur',
        'statut'
    ];

    protected $casts = [
        'date_debut' => 'date',
        'date_fin' => 'date',
        'remuneration' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class, 'id_entreprise');
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }
}