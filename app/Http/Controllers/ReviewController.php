<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function get_reviews()
    {
        $reviews = Review::with('user')->latest()->get();

        return response()->json([
            'status' => 'success',
            'reviews' => $reviews
        ]);
    }

    public function store(Request $request)
    {
        $review = Review::create([
            'user_id' => auth()->user()->id,
            'stars' => $request->stars,
            'review' => $request->review,
        ]);
    }
}
