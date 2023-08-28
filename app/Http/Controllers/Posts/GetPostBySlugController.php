<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Support\Facades\Redis;

class GetPostBySlugController extends Controller
{
    public function __invoke ($slug, $lang)
    {
        $post = Post::where('slug_' . $lang, $slug)->with('tags')->first();

        if ($post)
        {
            // Get the view count from Redis
            $viewCount = Redis::incr("post:{$post->id}:views");

            // Include the view count in the response
            $post->view_count = $viewCount ?? 0;

            return response()->json($post);
        }
        else
        {
            return response()->json(['error' => 'Post not found'], 404);
        }
    }
}
