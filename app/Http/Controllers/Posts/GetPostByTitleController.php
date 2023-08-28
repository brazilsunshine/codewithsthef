<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class GetPostByTitleController extends Controller
{
    public function __invoke (Request $request)
    {
        \Log::info($request);

        try
        {
            $posts = Post::with('user')
                ->orderBy('id', 'desc')
                ->where('title_' . request('lang'), 'LIKE', request('postTitle') . '%') // search a post without having to type the full title
                ->paginate(5);
        }
        catch (\Exception $exception)
        {
            \Log::info(['GetPostByTitleController', $exception->getMessage()]);

            return [
                'success' => false,
                'msg' => 'problem'
            ];
        }

        return [
            'success' => true,
            'posts' => $posts
        ];
    }
}
