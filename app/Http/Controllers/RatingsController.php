<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Ratings;
use Illuminate\Http\Request;
use Validator;

class RatingsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function store(Request $request): array
    {
        $data = $request->validate([
            'post_id' => ['required', 'exists:posts,id'],
            'rating' => ['required', 'integer', 'between:1,5'],
        ]);

        Ratings::create([
            'post_id' => $request['post_id'],
            'rating' => $data['rating'],
        ]);

        $post = Posts::findOrFail($data['post_id']);

        return [
            'averageRating' => $post->averageRating()
        ];
    }
}
