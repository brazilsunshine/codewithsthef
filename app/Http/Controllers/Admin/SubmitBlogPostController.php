<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;


class SubmitBlogPostController extends Controller
{
    public function __construct ()
    {
        $this->middleware('admin');
    }

    public function __invoke (Request $request)
    {
        \Log::info($request);

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

        try
        {
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

            $slug = 'slug_' . $request->lang;

            $title = 'title_' . $request->lang;

            $description = 'description_' . $request->lang;

           $post = Post::create([
               'user_id' => $userId,
               'cover_photo' => $url,
               $slug => Str::slug($request->title),
               $title => $request->title,
               $description => $request->description,
           ]);

            $tags = collect($request->input('tags'))->map(function($tag)
            {
                return Tag::firstOrCreate(['name' => $tag])->id;
            });

            $post->tags()->attach($tags);

            // Increment view count
            $redisKey = "post:$post->id:views";
            Redis::incr($redisKey);
        }
        catch (\Exception $exception)
        {
            \Log::info(['SubmitBlogPostController', $exception->getMessage()]);

            return response()->json([
                'success' => false,
                'msg' => 'problem'
            ], 500);
        }

        return [
            'post' => $post
        ];
    }
}
