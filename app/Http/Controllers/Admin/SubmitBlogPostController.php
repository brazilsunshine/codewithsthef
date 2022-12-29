<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SubmitBlogPostController extends Controller
{
    public function __construct ()
    {
        $this->middleware('admin');
    }

    public function __invoke (Request $request)
    {
        $request->validate([
            'title' => 'required|min:4',
            'description' => 'required|min:5',
        ]);

        if (!auth()->check()) {
            return [
                'success' => false,
                'msg' => 'user not authenticated'
            ];
        }

        $file = $request->file('file'); // /tmp/php7S8v..

        $path = $file->hashName();

        $image = Image::make($file)->fit(1000, 1000);

        // Ternary operator: one line if else statement
        $disk = (app()->environment() === 'production')
            ? 'do'
            : 'local';

        $filesystem = Storage::disk($disk);
        $filesystem->put($path, $image->stream(), 'public');

        // our image will live here
        $url = $filesystem->url($path);

        $userId = auth()->user()->id;

        try
        {
           $post = Post::create([
               'user_id' => $userId,
               'title' => $request->title,
               'cover_photo' => $url,
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
