<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    protected $primaryKey = 'id_tache';
    protected $fillable = ['id_projet', 'id_employe', 'titre', 'description', 'assigne', 'date_debut', 'date_fin'];


    public function projet()
    {
        return $this->belongsTo(Projet::class, 'id_projet');
    }


    public function employe()
    {
        return $this->belongsTo(Employe::class, 'id_employe');
    }
}
