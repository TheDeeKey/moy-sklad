<?php

namespace App\Http\Controllers;

use App\Http\Resources\MoySklad\CategoryResource;
use App\Http\Resources\MoySklad\CustomerOrderResource;
use App\Http\Resources\MoySklad\ProductResource;
use App\Http\Resources\MoySklad\StoreResource;
use App\Http\Resources\MoySklad\RetailstoreResource;
use App\Http\Resources\MoySklad\UomResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MoySkladController extends Controller
{
    private $base_url = "https://online.moysklad.ru/api/remap/1.2/entity";

    public function getAllData(Request $request)
    {
        session(['bearer_token' => $request->bearerToken()]);

        $productResource = ProductResource::collection($this->toJson($request->bearerToken(), '/product'));
        $productFolderResource = CategoryResource::collection($this->toJson($request->bearerToken(), '/productfolder'));
        $storeResource = StoreResource::collection($this->toJson($request->bearerToken(), '/store'));
        $retailstoreResource = RetailstoreResource::collection($this->toJson($request->bearerToken(), '/retailstore'));
        $customerorderResource = CustomerOrderResource::collection($this->toJson($request->bearerToken(), '/customerorder'));
        $uomResource = UomResource::collection($this->toJson($request->bearerToken(), '/uom'));

        return [
            'product' => $productResource,
            'product_folder' => $productFolderResource,
            'store' => $storeResource,
            'retailstore' => $retailstoreResource,
            'customerorder' => $customerorderResource,
            'uom' => $uomResource
        ];
    }

    private function toJson ($token,$endpoint) {
        $list = Http::withToken($token)->get($this->base_url . '' .$endpoint);
        $listToJson = json_decode($list);

        return $listToJson->rows;
    }
}
