<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'description'];

    public function tuteurs()
    {
        return $this->belongsToMany(ProfilTuteur::class, 'tuteur_matieres')
                    ->withPivot('niveau');
    }

    public function sujets()
    {
        return $this->hasMany(SujetExamen::class);
    }

    public function soumissions()
    {
        return $this->hasMany(SoumissionEtudiant::class);
    }
}