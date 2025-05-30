<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnneeAcademique extends Model
{
    use HasFactory;

    protected $fillable = ['annee_debut', 'annee_fin', 'description'];

    public function sujets()
    {
        return $this->hasMany(SujetExamen::class, 'annee_id');
    }

    public function soumissions()
    {
        return $this->hasMany(SoumissionEtudiant::class, 'annee_id');
    }
}