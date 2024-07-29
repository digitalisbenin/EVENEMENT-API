<?php

namespace App\Http\Resources\Temoinage;


use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class TemoinageResource extends JsonResource
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
            'title' => $this->title,
            'content' => $this->content,
            'status'=>$this->status,
            'user'=> new UserResource($this->user),
            
        ];
    }
}
