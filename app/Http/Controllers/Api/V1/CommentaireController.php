<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Commentaire\CommentaireResource;
use App\Http\Requests\Commentaire\StoreCommentaireRequest;
use App\Http\Resources\Commentaire\CommentaireCollection;
use App\Models\Commentaire;
use Illuminate\Http\Request;

class CommentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    public function getCommentaire(Request $request)
    {
        $request->validate([
                'demande_id' => 'required',
    
            ]);
            $commentaire = Commentaire::orWhere('demande_id', $request->demande_id)->get();
            return new CommentaireCollection($commentaire);
    
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCommentaireRequest $request)
    {
        $commentaire = Commentaire::create($request->all());

        return new CommentaireResource($commentaire);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function show(Commentaire $commentaire)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Commentaire $commentaire)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Commentaire  $commentaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(Commentaire $commentaire)
    {
        //
    }
}
