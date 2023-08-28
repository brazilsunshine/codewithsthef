<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class GetPostByTagController extends Controller
{
    public function __invoke ()
    {
        \Log::info(request()->all());

        try
        {
            // Find the tag by its name
            $tag = Tag::where('name', request('tag'))->first();

            $posts = $tag->posts()->with('user', 'tags')->paginate(5);
        }
        catch (\Exception $exception)
        {
            \Log::info(['GetPostByTagController', $exception->getMessage()]);

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
