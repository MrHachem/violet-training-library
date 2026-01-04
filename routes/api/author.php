<?php

use App\Http\Controllers\Api\AuthorController;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\delete;

Route::controller(AuthorController::class)->prefix('author')->name('author.')->group(function(){

    Route::get('index', 'index')->name('index');
    Route::post('create', 'store')->name('create');
    Route::patch('update/{author}', 'update')->whereNumber('author')->name('update');
    Route::delete('delete/{author}', 'destroy')->whereNumber('author')->name('delete');
    
});