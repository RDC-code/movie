<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    // List all movies with thumbnail URLs
    public function index()
    {
        $movies = Movie::all()->map(function ($movie) {
            $movie->thumbnail_url = $movie->thumbnail 
                ? asset('storage/' . $movie->thumbnail) 
                : null;
            return $movie;
        });

        return response()->json($movies);
    }

    // Store a new movie
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png|max:20480',
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        $movie = Movie::create($data);

        $movie->thumbnail_url = $movie->thumbnail 
            ? asset('storage/' . $movie->thumbnail) 
            : null;

        return response()->json($movie, 201);
    }

    // Update an existing movie
    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png|max:20480',
            'existingThumbnail' => 'nullable|string',
        ]);

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($movie->thumbnail) {
                Storage::disk('public')->delete($movie->thumbnail);
            }

            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        } elseif (!empty($data['existingThumbnail'])) {
            $data['thumbnail'] = $data['existingThumbnail'];
        }

        unset($data['existingThumbnail']);

        $movie->update($data);

        $movie->thumbnail_url = $movie->thumbnail 
            ? asset('storage/' . $movie->thumbnail) 
            : null;

        return response()->json($movie);
    }

    // Delete a movie
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        if ($movie->thumbnail) {
            Storage::disk('public')->delete($movie->thumbnail);
        }

        $movie->delete();

        return response()->json(['message' => 'Movie deleted successfully']);
    }

    // Get all movie ratings with movie and user details
  public function getAllRatings()
    {
        $ratings = Rating::with(['movie', 'user'])->get();

        $result = $ratings->map(function($rating) {
            return [
                'id' => $rating->id,
                'movie_title' => $rating->movie->title,
                'rating' => $rating->rating,
                'username' => $rating->user->name,
            ];
        });

        return response()->json($result);
    }

    public function deleteRating($id)
    {
        $rating = Rating::findOrFail($id);
        $rating->delete();

        return response()->json(['message' => 'Rating deleted successfully']);
    }


}
