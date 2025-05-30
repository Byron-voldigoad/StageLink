<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SujetExamen extends Model
{
    use HasFactory;

    protected $fillable = [
        'titre',
        'matiere_id',
        'niveau_id',
        'annee_id',
        'fichier_path',
        'est_gratuit',
        'prix',
        'upload_par',
        'approuve',
        'telechargements'
    ];

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }

    public function niveau()
    {
        return $this->belongsTo(Niveau::class);
    }

    public function annee()
    {
        return $this->belongsTo(AnneeAcademique::class, 'annee_id');
    }

    public function uploader()
    {
        return $this->belongsTo(Utilisateur::class, 'upload_par');
    }

    public function corriges()
    {
        return $this->hasMany(CorrigeExamen::class);
    }
}