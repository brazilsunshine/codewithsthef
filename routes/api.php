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
Route::post('/logout', 'Auth\LogoutController');

Route::get('/user/check-auth', 'Auth\CheckAuthController');

Route::get('/posts/get-paginated-posts', 'Posts\GetPaginatedPostsController');

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/posts/upload-image-blog-html', 'Admin\UploadImageBlogHtmlController');
    Route::post('/posts/submit-blog-post', 'Admin\SubmitBlogPostController');
    Route::post('/posts/submit-edited-post', 'Admin\SubmitEditedPostController');
    Route::post('/posts/delete-post', 'Admin\DeletePostController');
});
