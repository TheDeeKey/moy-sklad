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
        //TODO что если придет строка
        $limit = $request->query('limit') ?? 1000;
        $offset = $request->query('offset') ?? 0;
        session(['bearer_token' => $request->bearerToken()]);

        return [
            'product' => ProductResource::collection($this->toJson($request->bearerToken(), '/product?limit=' . $limit . '&offset=' . $offset)),
//            'product_folder' => CategoryResource::collection($this->toJson($request->bearerToken(), '/productfolder?limit=' . $limit . '&offset=' . $offset)),
//            'store' => StoreResource::collection($this->toJson($request->bearerToken(), '/store?limit=' . $limit . '&offset=' . $offset)),
//            'retailstore' => RetailstoreResource::collection($this->toJson($request->bearerToken(), '/retailstore?limit=' . $limit . '&offset=' . $offset)),
//            'customerorder' => CustomerOrderResource::collection($this->toJson($request->bearerToken(), '/customerorder?limit=' . $limit . '&offset=' . $offset)),
//            'uom' => UomResource::collection($this->toJson($request->bearerToken(), '/uom?limit=' . $limit . '&offset=' . $offset))
        ];
    }

    private function toJson($token, $endpoint)
    {
        $list = Http::withToken($token)->get($this->base_url . '' . $endpoint);
        $listToJson = json_decode($list);

        return $listToJson->rows;
    }
}
