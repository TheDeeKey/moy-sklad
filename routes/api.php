<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::prefix('my-sklad')->group(function () {

    $base_url = "https://online.moysklad.ru/api/remap/1.2/entity";

    // Склады
    Route::prefix('store')->group(function () use ($base_url) {
        // Получение списка складов
        Route::get('/', function (Request $request) use ($base_url) {
            //TODO
            $limit = $request->query('limit') ?? 10;
            //c65eaa235d5c1695cf7f5aa9993498952b56cf90

            return Http::withToken($request->bearerToken())->get($base_url .'/store?limit=' . $limit);
        });

        // Получение склада
        Route::get('{id}', function (Request $request, $id) use ($base_url) {
            return Http::withToken($request->bearerToken())->get($base_url .'/store/' . $id);
        });

        // Создание нового склада
        Route::post('/', function (Request $request) use ($base_url) {
            // name
            // ID из файла выгрузки
            // Город
            // Широта
            // Долгота
            // Зоны доставок
            // Филлиалы
            // Изображение

            $response = Http::withToken($request->bearerToken())->post($base_url .'/store', [
                'name' => $request->name
            ]);

            return $response;
        });

        // Редактирование конкретного склада
        Route::put('{id}', function (Request $request, $id) use ($base_url) {
            // name
            // ID из файла выгрузки
            // Город -> addressFull -> city
            // Широта
            // Долгота
            // Зоны доставок
            // Филлиалы
            // Изображение

            $response = Http::withToken($request->bearerToken())->put($base_url .'/store/' . $id, [
                'name' => $request->name
            ]);

            return $response;
        });

        // Удаление склада
        Route::delete('{id}', function (Request $request, $id) use ($base_url) {
            $response = Http::withToken($request->bearerToken())->delete($base_url .'/store/' . $id);

            return $response;
        });
    });

    // Товар
    Route::prefix('product')->group(function () use ($base_url) {

        //Список товаров
        Route::get('/', function (Request $request) use ($base_url) {
            $limit = $request->query('limit') ?? 15;
            //TODO Pagination
            //c65eaa235d5c1695cf7f5aa9993498952b56cf90

            return Http::withToken($request->bearerToken())->get($base_url .'/product?limit=' . $limit);
        });

        // Получение товара
        Route::get('{id}', function (Request $request, $id) use ($base_url) {
            return Http::withToken($request->bearerToken())->get($base_url .'/product/' . $id);
        });

        // Создание нового товара
        Route::post('/', function (Request $request) use ($base_url) {
            // name
            // ID из файла выгрузки
            // Город
            // Широта
            // Долгота
            // Зоны доставок
            // Филлиалы
            // Изображение

            $response = Http::withToken($request->bearerToken())->post($base_url .'/product', [
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return $response;
        });

        // Удаление товара
        Route::delete('{id}', function (Request $request, $id) use ($base_url) {
            $response = Http::withToken($request->bearerToken())->delete($base_url .'/product/' . $id);

            return $response;
        });

        // Массовое удаление товаров
        Route::post('/delete', function (Request $request) use ($base_url) {
            // name
            // ID из файла выгрузки
            // Город
            // Широта
            // Долгота
            // Зоны доставок
            // Филлиалы
            // Изображение

            $response = Http::withToken($request->bearerToken())->post($base_url .'/product/delete', $request->all());

            return $response;
        });

        // Обновление товара
        Route::put('{id}', function (Request $request, $id) use ($base_url) {
            // name
            // ID из файла выгрузки
            // Город -> addressFull -> city
            // Широта
            // Долгота
            // Зоны доставок
            // Филлиалы
            // Изображение

            $response = Http::withToken($request->bearerToken())->put($base_url .'/product/' . $id, [
                'name' => $request->name
            ]);

            return $response;
        });
    });

    // Группа товаров
    Route::prefix('productfolder')->group(function () use ($base_url) {

        //Список списка точек продаж
        Route::get('/', function (Request $request) use ($base_url) {
            $limit = $request->query('limit') ?? 20;
            //TODO Pagination

            return Http::withToken($request->bearerToken())->get($base_url .'/productfolder');
        });

        // Получение точки продаж по айди
        Route::get('{id}', function (Request $request, $id) use ($base_url) {
            return Http::withToken($request->bearerToken())->get($base_url .'/productfolder/' . $id);
        });

        // Создание новой точки продаж
        Route::post('/', function (Request $request) use ($base_url) {

            $response = Http::withToken($request->bearerToken())->post($base_url . '/productfolder', [
                'name' => $request->name,
                'organization' => $request->organization,
                'store' => $request->store,
                'priceType' => $request->priceType,
            ]);

            return $response;
        });

        // Удаление точки продаж
        Route::delete('{id}', function (Request $request, $id) use ($base_url) {
            $response = Http::withToken($request->bearerToken())->delete($base_url . '/productfolder/' . $id);

            return $response;
        });

        // Обновление точки продаж
        Route::put('{id}', function (Request $request, $id) use ($base_url) {
            $response = Http::withToken($request->bearerToken())->put($base_url .'/productfolder/' . $id, [
                'name' => $request->name
            ]);

            return $response;
        });
    });

    // Точка продаж
    Route::prefix('retailstore')->group(function () use ($base_url) {

        //Список списка точек продаж
        Route::get('/', function (Request $request) use ($base_url) {
            $limit = $request->query('limit') ?? 15;
            //TODO Pagination

            return Http::withToken($request->bearerToken())->get($base_url .'/retailstore?limit=' . $limit);
        });

        // Получение точки продаж по айди
        Route::get('{id}', function (Request $request, $id) use ($base_url) {
            return Http::withToken($request->bearerToken())->get($base_url .'/retailstore/' . $id);
        });

        // Создание новой точки продаж
        Route::post('/', function (Request $request) use ($base_url) {

            $response = Http::withToken($request->bearerToken())->post($base_url . '/retailstore', [
                'name' => $request->name,
                'organization' => $request->organization,
                'store' => $request->store,
                'priceType' => $request->priceType,
            ]);

            return $response;
        });

        // Удаление точки продаж
        Route::delete('{id}', function (Request $request, $id) use ($base_url) {
            $response = Http::withToken($request->bearerToken())->delete($base_url . '/retailstore/' . $id);

            return $response;
        });

        // Обновление точки продаж
        Route::put('{id}', function (Request $request, $id) use ($base_url) {
            $response = Http::withToken($request->bearerToken())->put($base_url .'/retailstore/' . $id, [
                'name' => $request->name
            ]);

            return $response;
        });
    });

    // Заказ
    Route::prefix('customerorder')->group(function () use ($base_url) {

        //Список заказов пользователей
        Route::get('/', function (Request $request) use ($base_url) {
            $limit = $request->query('limit') ?? 20;
            //TODO Pagination

            return Http::withToken($request->bearerToken())->get($base_url .'/customerorder?limit=' . $limit);
        });

        // Получение заказа
        Route::get('{id}', function (Request $request, $id) use ($base_url) {
            return Http::withToken($request->bearerToken())->get($base_url .'/customerorder/' . $id);
        });

        // Создание нового заказа
        Route::post('/', function (Request $request) use ($base_url) {
            return Http::withToken($request->bearerToken())->post($base_url .'/customerorder', [
                'organization' => $request->organization,
                'agent' => $request->agent,
            ]);
        });

        // Массовое удаление заказов по метаданным
        Route::post('/delete', function (Request $request) use ($base_url) {
            return Http::withToken($request->bearerToken())->post($base_url .'/customerorder/delete', $request->all());
        });

        // Удаление заказа
        Route::delete('{id}', function (Request $request, $id) use ($base_url) {
            $response = Http::withToken($request->bearerToken())->delete($base_url . '/customerorder/' . $id);

            return $response;
        });

        // Обновление заказа
        Route::put('{id}', function (Request $request, $id) use ($base_url) {

            $response = Http::withToken($request->bearerToken())->put($base_url .'/customerorder/' . $id, [
                'organization' => $request->organization,
                'agent' => $request->agent,
                'organizationAccount ' => $request->organizationAccount,
                'agentAccount ' => $request->agentAccount,
            ]);

            return $response;
        });
    });

    // Единицы измерения
    Route::prefix('uom')->group(function () use ($base_url) {

        //Список списка точек продаж
        Route::get('/', function (Request $request) use ($base_url) {
            $limit = $request->query('limit') ?? 20;
            //TODO Pagination

            return Http::withToken($request->bearerToken())->get($base_url .'/uom');
        });

        // Получение точки продаж по айди
        Route::get('{id}', function (Request $request, $id) use ($base_url) {
            return Http::withToken($request->bearerToken())->get($base_url .'/uom/' . $id);
        });

        // Создание новой точки продаж
        Route::post('/', function (Request $request) use ($base_url) {

            $response = Http::withToken($request->bearerToken())->post($base_url . '/uom', [
                'name' => $request->name,
                'organization' => $request->organization,
                'store' => $request->store,
                'priceType' => $request->priceType,
            ]);

            return $response;
        });

        // Удаление точки продаж
        Route::delete('{id}', function (Request $request, $id) use ($base_url) {
            $response = Http::withToken($request->bearerToken())->delete($base_url . '/uom/' . $id);

            return $response;
        });

        // Обновление точки продаж
        Route::put('{id}', function (Request $request, $id) use ($base_url) {
            $response = Http::withToken($request->bearerToken())->put($base_url .'/uom/' . $id, [
                'name' => $request->name
            ]);

            return $response;
        });
    });

    // Характеристики товаров
    Route::prefix('variant')->group(function () use ($base_url) {

        //Список характеристик товаров
        Route::get('/', function (Request $request) use ($base_url) {
            $limit = $request->query('limit') ?? 20;
            //TODO Pagination

            return Http::withToken($request->bearerToken())->get($base_url .'/variant');
        });

        // Получение
        Route::get('{id}', function (Request $request, $id) use ($base_url) {
            return Http::withToken($request->bearerToken())->get($base_url .'/variant/' . $id);
        });

        // Создание новой характеристики
        Route::post('/', function (Request $request) use ($base_url) {

            $response = Http::withToken($request->bearerToken())->post($base_url . '/variant', [
                'name' => $request->name,
                'organization' => $request->organization,
                'store' => $request->store,
                'priceType' => $request->priceType,
            ]);

            return $response;
        });

        // Удаление характеристики
        Route::delete('{id}', function (Request $request, $id) use ($base_url) {
            $response = Http::withToken($request->bearerToken())->delete($base_url . '/variant/' . $id);

            return $response;
        });

        // Обновление характеристики
        Route::put('{id}', function (Request $request, $id) use ($base_url) {
            $response = Http::withToken($request->bearerToken())->put($base_url .'/variant/' . $id, [
                'name' => $request->name
            ]);

            return $response;
        });
    });
});
