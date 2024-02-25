<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $primaryKey = 'id_vente';
    protected $guarded = [];
    use HasFactory;
}
