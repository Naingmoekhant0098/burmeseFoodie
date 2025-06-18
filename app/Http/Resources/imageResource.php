<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use phpDocumentor\Reflection\Types\Integer;

class imageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=> (int)$this->id,
            'parent_id'=>(string)$this->parent_id,
            'parent_type'=>(string)$this->parent_type,
            'image_type'=>(string)$this->image_type,
            'path'=>(string)$this->path,
            'size'=>(int) $this->size,
        ];
    }
}
