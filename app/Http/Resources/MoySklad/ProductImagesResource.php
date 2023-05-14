<?php

namespace App\Http\Resources\MoySklad;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductImagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'width' => 0,
            'height' => 0,
            'url' => $this->meta->downloadHref,
        ];
    }
}
