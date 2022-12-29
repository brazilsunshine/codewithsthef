<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class SubmitEditedPostController extends Controller
{
    public function __construct ()
    {
        $this->middleware('admin');
    }

    public function __invoke (Request $request)
    {
        $request->validate([
            'title' => 'min:4',
            'description' => 'min:5',
        ]);

        if (!auth()->check()) {
            return [
                'success' => false,
                'msg' => 'user not authenticated'
            ];
        }

        try
        {
            $post = Post::where('id', $request->postId)->first();

            $title = 'title_' . $request->lang;

            $description = 'description_' . $request->lang;

            $post->$title = $request->title;

            $post->$description = $request->description;

            $post->save();
        }
        catch (\Exception $exception)
        {
            \Log::info(['SubmitEditedPostController', $exception->getMessage()]);

            return [
                'success' => false,
                'msg' => 'problem'
            ];
        }

        return [
            'success' => true,
            'editedPost' => $post
        ];
    }

}
