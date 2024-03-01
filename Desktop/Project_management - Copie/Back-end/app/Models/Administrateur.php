<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrateur extends Model
{
    protected $primaryKey = 'id_adminitrateur';
    protected $fillable = ['nom', 'prenom', 'email', 'mot_de_passe', 'tele', 'photo'];


    public function projets()
    {
        return $this->hasMany(Projet::class, 'id_adminitrateur');
    }

    public function gestionnaires()
    {
        return $this->hasMany(Gestionnaire::class, 'id_adminitrateur');
    }
}
