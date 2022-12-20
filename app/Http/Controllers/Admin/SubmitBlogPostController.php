<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SubmitBlogPostController extends Controller
{
    public function __invoke (Request $request)
    {
        $request->validate([
            'title' => 'required|min:4',
            'cover_photo' => 'required',
            'description' => 'required|min:5',
        ]);

        if (!auth()->check()) {
            return [
                'success' => false,
                'msg' => 'user not authenticated'
            ];
        }

        $userId = auth()->user()->id;

        try
        {
           $post = Post::create([
               'user_id' => $userId,
               'title' => $request->title,
               'cover_photo' => $request->cover_photo,
               'description' => $request->description,
           ]);
        }
        catch (\Exception $exception)
        {
            \Log::info(['SubmitBlogPostController', $exception->getMessage()]);

            return [
                'success' => false,
                'msg' => 'problem'
            ];
        }

        return [
            'success' => true,
            'post' => $post
        ];
    }
}
