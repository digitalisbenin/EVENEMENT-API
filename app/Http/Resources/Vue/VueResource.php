<?php

namespace App\Http\Resources\Vue;

use Illuminate\Http\Resources\Json\JsonResource;

class VueResource extends JsonResource
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
            'vue'=>$this->vue,
            'demande_id'=>$this->demande_id,
            
            
            
        ];
    }
}
