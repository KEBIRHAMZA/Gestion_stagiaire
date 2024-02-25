<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class ProduitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produits = Produit::all();

        if ($produits->count() > 0) {
            return response()->json([
                'status' => 200,
                'produits' => $produits
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Aucun produit n'existe"
            ], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|string',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $produit = Produit::create([
                'libelle' => $request->libelle,
                'prix' => $request->prix,
                'quantite' => $request->quantite
            ]);

            if ($produit) {
                return response()->json([
                    'status' => 200,
                    'message' => 'Le produit a été ajouté avec succès'
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => "Quelque chose s'est mal passé"
                ], 500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produit = Produit::find($id);

        if ($produit) {
            return response()->json([
                'status' => 200,
                'produit' => $produit
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Aucun produit correspondant à cet identifiant n'a été trouvé"
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'libelle' => 'required|string',
            'prix' => 'required|numeric',
            'quantite' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $produit = Produit::find($id);

            if ($produit) {
                $produit->update([
                    'libelle' => $request->libelle,
                    'prix' => $request->prix,
                    'quantite' => $request->quantite
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'Le produit a été modifié avec succès'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "Le produit n'existe pas"
                ], 404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produit = Produit::find($id);

        if ($produit) {
            $produit->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Le produit a été supprimé avec succès'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Le produit n'existe pas"
            ], 404);
        }
    }
}
