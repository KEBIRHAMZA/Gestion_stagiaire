<?php

namespace App\Models;

use App\Models\Client;
use App\Models\Fournisseur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produit extends Model
{
    protected $primaryKey = 'id_produit';
    protected $guarded = [];
    use HasFactory;

    public function clients(){
        return $this->belongsToMany(Client::class)->withPivot('date_vente','quantite');
    }

    public function fornisseurs(){
        return $this->belongsToMany(Fournisseur::class)->withPivot('date_achat','quantite');
    }
}
