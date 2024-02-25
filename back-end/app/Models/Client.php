<?php

namespace App\Models;

use App\Models\Vente;
use App\Models\Produit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    protected $primaryKey = 'id_client';
    protected $guarded = [];
    use HasFactory;

    public function produits(){
        return $this->belongsToMany(Produit::class)->withPivot('date_vente','quantite');
    }
}
