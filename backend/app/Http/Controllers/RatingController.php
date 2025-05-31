<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Movie;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function store(Request $request, $movieId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
        ]);

        // If using Sanctum:
        $user = Auth::user();

        // If not using auth yet, use a fallback for testing:
        if (!$user) {
            $user = \App\Models\User::first(); // TEMP fallback for testing
        }

        $movie = Movie::findOrFail($movieId);

        // Update or create the user's rating for this movie
        Rating::updateOrCreate(
            ['user_id' => $user->id, 'movie_id' => $movie->id],
            ['rating' => $request->rating]
        );

        return response()->json(['message' => 'Rating submitted successfully.']);
    }
}
