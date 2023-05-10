<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/






Route::get('/moy-sklad/', function () {
    $response = Http::withHeaders([
        'Authorization' => 'Basic c65eaa235d5c1695cf7f5aa9993498952b56cf90'
    ])->post("https://online.moysklad.ru/api/remap/1.2/security/token");
});


//c65eaa235d5c1695cf7f5aa9993498952b56cf90
