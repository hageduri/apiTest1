<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiController1;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get("data",[apiController1::class,'getData']);
Route::get("list/{id?}",[apiController1::class,'list']);
Route::post("add",[apiController1::class,'add']);
Route::put("update",[apiController1::class,'update']);
Route::get("search/{name}",[apiController1::class,'search']);
Route::delete("delete/{id}",[apiController1::class,'delete']);
