<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    protected $primaryKey = 'id_employe';
    protected $fillable = ['id_equipe', 'id_gestionnaire', 'respo', 'nom', 'prenom', 'email', 'mot_de_passe', 'tele', 'photo'];


    public function equipe()
    {
        return $this->belongsTo(Equipe::class, 'id_equipe');
    }

    public function gestionnaire()
    {
        return $this->belongsTo(Gestionnaire::class, 'id_gestionnaire');
    }


    public function taches()
    {
        return $this->hasMany(Tache::class, 'id_employe');
    }
}
