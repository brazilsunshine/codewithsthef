<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('root');
});

Route::get('/register', function () {
    return view('root');
});

Route::get('/login', function () {
    return view('root');
});

Route::get('/contact', function () {
    return view('root');
});

Route::get('/projects', function () {
    return view('root');
});

Route::get('/posts/{slug}/{lang}', function () {
    return view('root');
});

Route::get('/admin/create-post', function () {
    return view('root');
});

Route::get('/admin/blog-preview', function () {
    return view('root');
});

Route::get('/admin/add-admin', function () {
    return view('root');
});
