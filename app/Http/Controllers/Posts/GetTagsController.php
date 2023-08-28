<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class GetTagsController extends Controller
{
    public function __invoke ()
    {
        $tags = Tag::all();

        return [
            'success' => true,
            'tags' => $tags
        ];
    }
}
