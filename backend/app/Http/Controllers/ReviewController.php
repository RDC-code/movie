<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Return all reviews with stars (no text necessary)
    public function index()
    {
        $reviews = Review::with(['movie', 'user'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function($review) {
                return [
                    'id' => $review->id,
                    'movie_id' => $review->movie_id,
                    'movie_title' => $review->movie->title,
                    'rating' => $review->rating,          // star rating 1-5
                    'user_name' => $review->user->name,
                    'created_at' => $review->created_at,
                ];
            });

        return response()->json($reviews);
    }

    // Delete a review
    public function destroy($id)
    {
        $review = Review::find($id);
        if (!$review) {
            return response()->json(['message' => 'Review not found'], 404);
        }
        $review->delete();
        return response()->json(['message' => 'Review deleted']);
    }

    // Submit star rating only
    public function rateMovie(Request $request, $movieId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $user = Auth::user();

        $movie = Movie::find($movieId);
        if (!$movie) {
            return response()->json(['message' => 'Movie not found'], 404);
        }

        // Check if user already rated this movie
        $review = Review::where('user_id', $user->id)
                        ->where('movie_id', $movieId)
                        ->first();

        if ($review) {
            // Update star rating only
            $review->rating = $request->rating;
            $review->save();
        } else {
            // Create new review with rating only, no review_text
            $review = Review::create([
                'user_id' => $user->id,
                'movie_id' => $movieId,
                'rating' => $request->rating,
                'review_text' => null,  // no text
            ]);
        }

        // Calculate average star rating and count for this movie
        $averageRating = Review::where('movie_id', $movieId)->avg('rating');
        $ratingsCount = Review::where('movie_id', $movieId)->count();

        return response()->json([
            'average_rating' => round($averageRating, 2),
            'ratings_count' => $ratingsCount,
        ]);
    }
}
