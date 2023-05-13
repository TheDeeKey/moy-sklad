<?php

namespace App\Http\Resources\MoySklad;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, // uuid?
            'name' => $this->name,
            'id_crm' =>  $this->article ?? 'none', //article
            'parentid' => 'none',
            'position' => 'desc',
            'text' => $this->description ?? 'none',
            'picture' => 'none',
            'view' => true,

        ];
    }
}
