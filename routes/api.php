<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/register', 'Auth\RegisterController');
Route::post('/login', 'Auth\LoginController');
Route::post('/logout', 'Auth\LogoutController');
Route::post('/contact', 'Contact\ContactController');

Route::get('/user/check-auth', 'Auth\CheckAuthController');

/** POSTS **/
Route::get('/posts/get-paginated-posts', 'Posts\GetPaginatedPostsController');
Route::get('/posts/get-filtered-posts', 'Posts\GetFilteredPostsController');
Route::get('/posts/{slug}/{lang}', 'Posts\GetPostBySlugController');
Route::get('/posts/get-posts-by-title', 'Posts\GetPostByTitleController');
Route::get('/posts/get-tags', 'Posts\GetTagsController');
Route::get('/posts-by-tag', 'Posts\GetPostByTagController');

/** MIDDLEWARE */
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/posts/upload-image-blog-html', 'Admin\UploadImageBlogHtmlController');
    Route::post('/posts/submit-blog-post', 'Admin\SubmitBlogPostController');
    Route::post('/posts/submit-edited-post', 'Admin\SubmitEditedPostController');
    Route::post('/posts/delete-post', 'Admin\DeletePostController');

    Route::post('/admin/add-admin', 'Admin\AddAdminController');
});
