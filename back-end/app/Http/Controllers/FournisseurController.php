<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fournisseur = Fournisseur::all();

        if($fournisseur->count() > 0){
            return response()->json([
                'status' => 200,
                'fournisseur' => $fournisseur
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'mesaage' => "ce fournisseur n'exist pas"
            ],404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nom' => 'required|string',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|numeric',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ],422);
        }else{
            $fournisseur = Fournisseur::create([
                'nom' => $request->nom,
                'adresse' => $request->adresse,
                'telephone' => $request->telephone
            ]);

            if($fournisseur){
                return response()->json([
                    'status' => 200,
                    'message' => 'Le fournisseur a été ajouté avec succès'
                ],200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => "Quelque chose s'est mal passé"
                ],500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fournisseur = Fournisseur::find($id);

        if($fournisseur){
            return response()->json([
                'status' => 200,
                'fournisseur' => $fournisseur
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Aucun fournisseur correspondant à cet identifiant n'a été trouvé"
            ],404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fournisseur = Fournisseur::find($id);

        if($fournisseur){
            return response()->json([
                'status' => 200,
                'fournisseur' => $fournisseur
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Aucun fournisseur correspondant à cet identifiant n'a été trouvé"
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(),[
            'nom' => 'required|string',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|numeric',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ],422);
        }else{
            $fournisseur = Fournisseur::find($id);

            if($fournisseur){
                $fournisseur->update([
                    'nom' => $request->nom,
                    'adresse' => $request->adresse,
                    'telephone' => $request->telephone
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'Le fournisseur a été modifié avec succès'
                ],200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => "Le fournisseur n'existe pas"
                ],404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fournisseur  $fournisseur
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $fournisseur = Fournisseur::find($id);

        if($fournisseur){
            $fournisseur->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Le fournisseur a été supprimé avec succès'
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Le fournisseur n'existe pas"
            ],404);
        }
    }
}
