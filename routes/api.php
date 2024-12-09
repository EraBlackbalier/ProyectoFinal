<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\FireBulletController;
use App\Http\Controllers\Api\BulletInfoController;
use App\Http\Controllers\Api\InventoryController;
use App\Http\Controllers\Api\SigIn;

Route::get('/inventoryT', [InventoryController::class, 'totalinventory'])->middleware('auth:sanctum');

Route::post('/SigIn', [SigIn::class, 'signin']);


Route::get('/bullets/{bulletId}/info', [BulletInfoController::class, 'getBulletInfo'])->middleware('auth:sanctum');


Route::post('/magazines/{magazineId}/fire', [FireBulletController::class, 'fire'])->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
