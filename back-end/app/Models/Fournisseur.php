<?php

namespace App\Models;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fournisseur extends Model
{
    protected $primaryKey = 'id_fournisseur';
    protected $guarded = [];
    use HasFactory;

    public function produits(){
        return $this->belongsToMany(Produit::class)->withPivot('date_achat','quantite');
    }
}
