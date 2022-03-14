<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "users", "name" => "users."], function () {
    Route::get('/', [App\Http\Controllers\UserController::class, 'index'])->name('index');
    Route::get('/{user}', [App\Http\Controllers\UserController::class, 'show'])
        ->where('user', '[0-9]+')
        ->name('show');
    Route::put('/{user}', [App\Http\Controllers\UserController::class, 'update'])->name('update');
    Route::get('/export', [App\Http\Controllers\UserController::class, 'exportUsers'])->name('export');
});
