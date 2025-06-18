<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ingredientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=>(string)$this->id,
            "name"=>(string)$this->name,
            "amount"=>(string)$this->amount,
            "unit"=>(string)$this->unit,
            "image"=>$this->image ? (new imageResource(($this->image))) : null
        ];
    }
}
