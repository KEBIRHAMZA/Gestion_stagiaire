<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AchatController;
use App\Http\Controllers\VenteController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\FournisseurController;

Route::resource('/clients', ClientController::class);
Route::resource('/fournisseurs', FournisseurController::class);
Route::resource('/produits', ProduitController::class);
Route::resource('/achats', AchatController::class);
Route::resource('/ventes', VenteController::class);
