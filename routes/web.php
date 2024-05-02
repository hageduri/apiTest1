<?php

use App\Http\Controllers\head_logoController;
use App\Http\Controllers\userController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('listView', [userController::class, 'listView'])->name('listView');
    // Route::get('/listView', function () {
    //     return view('listView');
    // })->name('listView');
});

//LogoHead
Route::get('/upload', function () {
    return View::make('upload');
})->name('upload');

//Hero_section
Route::get('/hero_section', function () {
    return View::make('hero_section');
})->name('hero_section');


Route::get('/set-flash-message', function () {
    session()->flash('message', 'This is a flash message!');
    return redirect()->route('show-flash-message');
});

Route::get('/show-flash-message', function () {
    return view('show-flash-message');
})->name('show-flash-message');
