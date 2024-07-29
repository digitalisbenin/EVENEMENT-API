<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\TypeDemande\TypeDemandeCollection;
use App\Http\Resources\TypeDemande\TypeDemandeResource;
use App\Models\Type_demande;
use Illuminate\Http\Request;

class Type_demandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new TypeDemandeCollection(Type_demande::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type_demande  $type_demande
     * @return \Illuminate\Http\Response
     */
    public function show(Type_demande $type_demande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type_demande  $type_demande
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type_demande $type_demande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type_demande  $type_demande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type_demande $type_demande)
    {
        //
    }
}
