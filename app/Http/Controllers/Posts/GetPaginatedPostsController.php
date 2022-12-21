<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class GetPaginatedPostsController extends Controller
{
    public function __invoke ()
    {
        $posts = Post::orderBy('id', 'desc') // will order the ideas by the last post date
        ->paginate(10);

        return [
            'success' => true,
            'posts' => $posts
        ];
    }
}
