<?php

namespace App\Http\Controllers;

use App\Models\Vente;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class VenteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ventes = Vente::all();

        if ($ventes->count() > 0) {
            return response()->json([
                'status' => 200,
                'ventes' => $ventes
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Aucune vente n'existe"
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
            'id_produit' => 'required|exists:produits,id_produit',
            'id_client' => 'required|exists:clients,id_client',
            'date_vente' => 'required|date',
            'quantite' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $vente = Vente::create([
                'id_produit' => $request->id_produit,
                'id_client' => $request->id_client,
                'date_vente' => $request->date_vente,
                'quantite' => $request->quantite
            ]);

            if ($vente) {
                return response()->json([
                    'status' => 200,
                    'message' => 'La vente a été ajoutée avec succès'
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
        $vente = Vente::find($id);

        if ($vente) {
            return response()->json([
                'status' => 200,
                'vente' => $vente
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Aucune vente correspondant à cet identifiant n'a été trouvée"
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_produit' => 'required|exists:produits,id_produit',
            'id_client' => 'required|exists:clients,id_client',
            'date_vente' => 'required|date',
            'quantite' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $vente = Vente::find($id);

            if ($vente) {
                $vente->update([
                    'id_produit' => $request->id_produit,
                    'id_client' => $request->id_client,
                    'date_vente' => $request->date_vente,
                    'quantite' => $request->quantite
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'La vente a été modifiée avec succès'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "La vente n'existe pas"
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
        $vente = Vente::find($id);

        if ($vente) {
            $vente->delete();
            return response()->json([
                'status' => 200,
                'message' => 'La vente a été supprimée avec succès'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "La vente n'existe pas"
            ], 404);
        }
    }
}
