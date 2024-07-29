<?php

namespace App\Http\Resources\Demande;


use App\Http\Resources\TypeDemande\TypeDemandeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DemandeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name'=>$this->name,
            'description'=>$this->description,
            'date_debuit' => $this->date_debuit,
            'date_fin'=>$this->date_fin,
            'lieu'=>$this->lieu,
            'telephone' => $this->telephone,
            'image'=>$this->image,
            'video'=>$this->video,
            'montant' => $this->montant,
            'nombre_jour'=>$this->nombre_jour,
            'is_correct'=>$this->is_correct,
            'status' => $this->status,
            'type_demande'=> new TypeDemandeResource($this->type_demande),
            
        ];
    }
}
