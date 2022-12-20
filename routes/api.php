<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/**
 * BACKEND ROUTES
 */
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register', 'Auth\RegisterController');
Route::post('/login', 'Auth\LoginController');

Route::get('/user/check-auth', 'Auth\CheckAuthController');

Route::post('/posts/upload-image-blog-html', 'Admin\UploadImageBlogHtmlController');
Route::post('/posts/submit-blog-post', 'Admin\SubmitBlogPostController');
Route::get('/posts/get-paginated-posts', 'Posts\GetPaginatedPostsController');

Route::group(['middleware' => ['auth:sanctum']], function () {

});
