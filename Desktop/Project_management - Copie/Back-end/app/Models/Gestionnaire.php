<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gestionnaire extends Model
{
    protected $primaryKey = 'id_gestionnaire';
    protected $fillable = ['nom', 'prenom', 'email', 'mot_de_passe', 'tele', 'photo'];

    public function administrateur()
    {
        return $this->belongsTo(Administrateur::class, 'id_adminitrateur');
    }

    public function employes(){
        return $this->hasMany(Employe::class, 'id_gestionnaire');
    }

    public function projects()
    {
        return $this->hasMany(Projet::class, 'id_gestionnaire');
    }

    public function equipes()
    {
        return $this->hasMany(Equipe::class, 'id_gestionnaire');
    }
}
