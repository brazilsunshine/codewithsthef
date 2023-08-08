<?php

namespace App\Http\Controllers\Posts;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class GetFilteredPostsController extends Controller
{
    public function __invoke (Request $request)
    {
        \Log::info($request);

        // Define the validation rules
        $rules = [
            'startDate' => 'required|date_format:Y-m-d',
            'endDate' => 'required|date_format:Y-m-d',
        ];

        // Run the validation
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            // If validation fails, return an error response
            return response()->json(['success' => false, 'error' => $validator->errors()], 422);
        }

        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        $query = Post::query();

        // load this data with my ideas
        $query->with('user')->orderBy('id', 'desc');

        if ($startDate && $endDate)
        {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
        elseif ($startDate)
        {
            $query->where('created_at', '>=', $startDate);
        }
        elseif ($endDate)
        {
            $query->where('created_at', '<=', $endDate);
        }

        $posts = $query->paginate(10);

        // Check if there are no posts for the selected date range
        if ($posts->isEmpty())
        {
            return response()->json(['success' => false, 'message' => 'No data found for the selected date range']);
        }

        return [
            'success' => true,
            'posts' => $posts
        ];

        //return response()->json($posts);
    }
}
