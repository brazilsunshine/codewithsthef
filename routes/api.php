<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/**
 * BACKEND ROUTES
 */
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/register', 'Auth\RegisterController');
