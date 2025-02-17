<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\Publication\PublicationCollection;
use App\Models\Publication;
use Illuminate\Http\Request;


class PublicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
 

    public function index()
    {
       // Récupère la date actuelle sans l'heure
       $today = date('Y-m-d');

       // Récupère les publications dont la publicité est valide pour aujourd'hui
       $publications = Publication::whereDate('date_debuit', '<=', $today) // Vérifie que la date_debuit est passée ou est égale à aujourd'hui
           ->whereRaw('DATE_ADD(date_debuit, INTERVAL nombre_jour DAY) >= ?', [$today]) // Vérifie que la date actuelle est dans la période de validité
           //->orderBy('nombre_jour', 'desc') // Trier par nombre_jour en ordre décroissant
           //->take(2) // Limiter à 2 résultats
           ->get();

       return new PublicationCollection($publications);
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
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function show(Publication $publication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publication $publication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publication $publication)
    {
        //
    }
}
