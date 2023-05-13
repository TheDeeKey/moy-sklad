<?php

namespace App\Http\Resources\MoySklad;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //example href: https://online.moysklad.ru/api/remap/1.2/entity/store/86191860-ec53-11ed-0a80-0f530091e995
        $storeIdInitialString = $this->store->meta->href ?? '';
        $store_id = '';



        if ($storeIdInitialString != '') {
            $store_id = substr($storeIdInitialString, strlen("https://online.moysklad.ru/api/remap/1.2/entity/store/"));
        }

        return [
            'id' => $this->id,
            'address' => $this->shipmentAddress ?? '',
            'summ' => $this->sum,
            'userid' => $this->accountId,
            'comment' => $this->description ?? '',
            'created_at' => $this->created,
            'warehouse_id' => $store_id
        ];
    }
}
