<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UploadPostCoverPhotoController extends Controller
{

//    public function __construct ()
//    {
//        $this->middleware('admin');
//    }


    public function __invoke (Request $request)
    {
        \Log::info($request->all());

        $request->validate([
            'file' => 'required|mimes:jpg,png,jpeg,heif,heic'
        ]);

        $file = $request->file('file'); // /tmp/php7S8v..

        $path = $file->hashName();

        $image = Image::make($file)->fit(1000, 1000);

        // Ternary operator: one line if else statement
        $disk = (app()->environment() === 'production')
            ? 's3'
            : 'local';

        $filesystem = Storage::disk($disk);
        $filesystem->put($path, $image->stream(), 'public');

        // our image will live here
        $url = $filesystem->url($path);

        return [
            'success' => true,
            'url' => $url
        ];
    }
}
