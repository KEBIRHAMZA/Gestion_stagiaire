<?php

namespace App\Http\Controllers;

use App\Models\Client;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::all();

        if($client->count() > 0){
            return response()->json([
                'status' => 200,
                'client' => $client
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'mesaage' => "ce client n'exist pas"
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
            $client = Client::create([
                'nom' => $request->nom,
                'adresse' => $request->adresse,
                'telephone' => $request->telephone
            ]);

            if($client){
                return response()->json([
                    'status' => 200,
                    'message' => 'Le client ete ajouter avec succee'
                ],200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => "quelque chose s'est mal passé"
                ],500);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        if($client){
            return response()->json([
                'status' => 200,
                'client' => $client
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "aucun client de ce type n'a été trouvé"
            ],404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);
        if($client){
            return response()->json([
                'status' => 200,
                'client' => $client
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "aucun client de ce type n'a été trouvé"
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

            $client = Client::find($id);

            if($client){
                $client->update([
                    'nom' => $request->nom,
                    'adresse' => $request->adresse,
                    'telephone' => $request->telephone
                ]);
                return response()->json([
                    'status' => 200,
                    'message' => 'Le client ete modifier avec succee'
                ],200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => "Le client n'existe pas"
                ],404);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find($id);
        if($client){
            $client->delete();
        }else{
            return response()->json([
                'status' => 404,
                'message' => "Le client n'existe pas"
            ],404);
        }
    }
}
