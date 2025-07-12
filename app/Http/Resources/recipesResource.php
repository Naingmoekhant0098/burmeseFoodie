<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class recipesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => (string) $this->id,
            'title' => (string) $this->title,
            'slug' => (string) $this->slug,
            'people_id' => (int) $this->people_id, 
            'rating' => (float) $this->rating, 
            'cuisine_id' => (int) $this->cuisine_id, 
            'images' => $this->images ? imageResource::collection($this->images) : null,  
            'description' => (string) $this->description,
            'nutrition' => $this->nutrition, 
            'prepare_time' => (string) $this->prepare_time, 
            'total_time' => (string) $this->total_time, 
            'cooking_time' => (int) $this->cooking_time, 
            'servings' => $this->servings,
            'steps' =>  $this->steps,
            'cost' => (float) $this->cost, 
            'category'=>$this->category ? (new categoryResource($this->category)) : null,
            'cuisine'=>$this->cuisine ? (new cuisineResource($this->cuisine)) : null,
            'ingredients'=>$this->ingredients ? (ingredientResource::collection($this->ingredients)) : null,
            'videoIds'=>$this->videoIds
        ];
    }
}
