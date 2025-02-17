<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Demande;
use App\Http\Resources\Demande\DemandeCollection;
use App\Http\Requests\Demande\UpdateDemandeRequest;
use App\Http\Resources\Demande\DemandeResource;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Récupération des demandes dont la date_debuit est égale ou supérieure à la date du jour
        $demandes = Demande::where('date_debuit', '>=', now())
        ->where('status', 'valider')
        ->orderByRaw('ABS(TIMESTAMPDIFF(SECOND, date_debuit, NOW()))') // Optionnel : trie par ordre croissant de date_debuit
            ->get();
    
        return new DemandeCollection($demandes);
    }

    public function indexValideEttande()
    {
        // // Récupération des demandes dont la date_debuit est égale ou supérieure à la date du jour
        // $demandes = Demande::where('date_debuit', '>=', now())
        // //->where('status', 'valider')
        // ->orderByRaw('ABS(TIMESTAMPDIFF(SECOND, date_debuit, NOW()))') // Optionnel : trie par ordre croissant de date_debuit
        //     ->get();
    
        // return new DemandeCollection($demandes);
        return new DemandeCollection(Demande::all());
    }
    
    public function getTerminer()
{
    

    return new DemandeCollection(Demande::all());
}


public function getDemandeTypeTerminer(Request $request)
{
    // Validation des données reçues
    $request->validate([
        'type_demande_id' => 'required|exists:type_demandes,id', // Vérifie que le type de demande existe
    ]);

    // Récupération des demandes correspondant au type_demande_id avec date_debuit >= aujourd'hui
    $demandes = Demande::where('type_demande_id', $request->type_demande_id)
        ->where('date_debuit', '<', now()) // Filtrer par date_debuit
        ->where('status', 'valider')
        ->orderByRaw('ABS(TIMESTAMPDIFF(SECOND, date_debuit, NOW()))')// Optionnel : trie par date_debuit croissante
        ->get();

    // Retourner les résultats sous forme de collection
    return new DemandeCollection($demandes);
}

    public function getDemandeType(Request $request)
    {
        // Validation des données reçues
        $request->validate([
            'type_demande_id' => 'required|exists:type_demandes,id', // Vérifie que le type de demande existe
        ]);
    
        // Récupération des demandes correspondant au type_demande_id avec date_debuit >= aujourd'hui
        $demandes = Demande::where('type_demande_id', $request->type_demande_id)
            ->where('date_debuit', '>=', now()) // Filtrer par date_debuit
            ->where('status', 'valider')
            ->orderByRaw('ABS(TIMESTAMPDIFF(SECOND, date_debuit, NOW()))')// Optionnel : trie par date_debuit croissante
            ->get();
    
        // Retourner les résultats sous forme de collection
        return new DemandeCollection($demandes);
    }
    

    public function getDemandeAdmin()
    {
        // Validation des données reçues
        // $request->validate([
        //     'user_id' => 'required|exists:users,id', // Vérifie que l'utilisateur existe
        // ]);
    
        // Récupération des demandes avec priorite=1, triées par date de création décroissante
        //$demandes = Demande::where('user_id', $request->user_id)
        $demandes = Demande::where('priorite', 1)
            ->where('date_debuit', '>=', now()) // Filtrer par date_debuit
            //->where('status', 'valider')
            ->orderByRaw('ABS(TIMESTAMPDIFF(SECOND, created_at, NOW()))')
            //->orderBy('created_at', 'desc') // Trie du plus récent au plus ancien
            ->get();
    
        // Retourne les données sous forme de collection
        return new DemandeCollection($demandes);
    }
//     public function getDemandeAdmin()
// {
//     // Récupération des demandes ayant priorite = 1, triées par date de création décroissante
//     $demandes = Demande::where('priorite', 1)
//         ->orderBy('created_at', 'desc') // Trie du plus récent au plus ancien
//         ->get();

//     // Retourne les données sous forme de collection
//     return new DemandeCollection($demandes);
// }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $demande = Demande::create($request->all());

        return new DemandeResource($demande);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $demande = Demande::findOrFail($id);
        return new DemandeResource($demande);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    
    public function update(UpdateDemandeRequest $request, $id)
    {
        $demande = Demande::find($id);
        $demande->update($request->all());

        return new DemandeResource($demande);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $demande = Demande::find($id);
        $demande->delete();
    }

}
