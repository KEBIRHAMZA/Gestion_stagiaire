<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    protected $primaryKey = 'id_projet';
    protected $fillable = ['id_adminitrateur', 'id_gestionnaire', 'titre', 'description', 'assigne', 'date_debut', 'date_fin'];

    public function administrateur()
    {
        return $this->belongsTo(Administrateur::class, 'id_adminitrateur');
    }


    public function gestionnaire()
    {
        return $this->belongsTo(Gestionnaire::class, 'id_gestionnaire');
    }


    public function equipes()
    {
        return $this->hasMany(Equipe::class, 'id_projet');
    }

    public function taches()
    {
        return $this->hasMany(Tache::class, 'id_projet');
    }
}
