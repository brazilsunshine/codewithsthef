<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class DeletePostController extends Controller
{
    public function __construct ()
    {
        $this->middleware('admin');
    }

    public function __invoke (Request $request)
    {
        if (!auth()->check()) {
            return [
                'success' => false,
                'msg' => 'user not authenticated'
            ];
        }
        \Log::info($request);

        try
        {
            $post = Post::where('id', $request->postId)->first();

            $post->delete();

        }
        catch (\Exception $exception)
        {
            \Log::info(['DeletePostController', $exception->getMessage()]);

            return [
                'success' => false,
                'msg' => 'problem'
            ];
        }

        return [
            'success' => true,
            'msg' => 'post deleted successfully'
        ];
    }
}
