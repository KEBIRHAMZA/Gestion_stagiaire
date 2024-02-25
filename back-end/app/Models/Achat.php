<?php

namespace App\Models;

use App\Models\Produit;
use App\Models\Fournisseur;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Achat extends Model
{
    protected $primaryKey = 'id_achat';
    protected $guarded = [];
    use HasFactory;
}
