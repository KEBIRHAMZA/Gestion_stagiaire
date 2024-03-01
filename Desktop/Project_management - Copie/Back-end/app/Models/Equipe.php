<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    protected $primaryKey = 'id_equipe';
    protected $fillable = ['id_projet', 'id_gestionnaire'];


    public function projet()
    {
        return $this->belongsTo(Projet::class, 'id_projet');
    }


    public function gestionnaire()
    {
        return $this->belongsTo(Gestionnaire::class, 'id_gestionnaire');
    }


    public function employes()
    {
        return $this->hasMany(Employe::class, 'id_equipe');
    }
}
