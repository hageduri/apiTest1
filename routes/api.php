<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiController1;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("data",[apiController1::class,'getData']);
Route::get("list/{id?}",[apiController1::class,'list']);
