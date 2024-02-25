<?php

namespace App\Http\Controllers;

use App\Models\Achat;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class AchatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $achats = Achat::all();

        if ($achats->count() > 0) {
            return response()->json([
                'status' => 200,
                'achats' => $achats
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Aucun achat n'existe"
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
            'id_fournisseur' => 'required|exists:fournisseurs,id_fournisseur',
            'date_achat' => 'required|date',
            'quantite' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $achat = Achat::create([
                'id_produit' => $request->id_produit,
                'id_fournisseur' => $request->id_fournisseur,
                'date_achat' => $request->date_achat,
                'quantite' => $request->quantite
            ]);

            if ($achat) {
                return response()->json([
                    'status' => 200,
                    'message' => 'L\'achat a été ajouté avec succès'
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
        $achat = Achat::find($id);

        if ($achat) {
            return response()->json([
                'status' => 200,
                'achat' => $achat
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "Aucun achat correspondant à cet identifiant n'a été trouvé"
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'id_produit' => 'required|exists:produits,id_produit',
            'id_fournisseur' => 'required|exists:fournisseurs,id_fournisseur',
            'date_achat' => 'required|date',
            'quantite' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else {
            $achat = Achat::find($id);

            if ($achat) {
                $achat->update([
                    'id_produit' => $request->id_produit,
                    'id_fournisseur' => $request->id_fournisseur,
                    'date_achat' => $request->date_achat,
                    'quantite' => $request->quantite
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'L\'achat a été modifié avec succès'
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => "L'achat n'existe pas"
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
        $achat = Achat::find($id);

        if ($achat) {
            $achat->delete();
            return response()->json([
                'status' => 200,
                'message' => 'L\'achat a été supprimé avec succès'
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "L'achat n'existe pas"
            ], 404);
        }
    }
}
