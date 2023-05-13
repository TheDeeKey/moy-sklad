<?php

namespace App\Http\Resources\MoySklad;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //example href: https://online.moysklad.ru/api/remap/1.2/entity/productfolder/be9f8eb7-ef67-11ed-0a80-08600000f992
        $parentIdInitialString = $this->productFolder->meta->href ?? '';
        $parent_id = '';

        if ($parentIdInitialString != '') {
            $parent_id = substr($parentIdInitialString, strlen("https://online.moysklad.ru/api/remap/1.2/entity/productfolder/"));
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->salePrices[0]->value,
            'priceold' => 0,
            'photo' => $this->images->meta->href,
            'text' => $this->description,
            'position' => 'desc', // ?
            'parentid' => $parent_id,
            'id_crm' => $this->article ?? '',
            'view' => true,
            'withproduct' => '',
            'count' => 0,
            'viewvariation' => $this->variantsCount > 0,
            'isvariant' => false,
            'productid' => 0,
            'barcode' => $this->barcodes[0]->ean13,
            'step' => '',
            'cart_limit' => '',
            'ban_on_discount' => $this->discountProhibited
        ];
    }
}
