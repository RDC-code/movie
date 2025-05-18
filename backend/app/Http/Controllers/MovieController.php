<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        // Return all movies with full thumbnail URL
        $movies = Movie::all()->map(function ($movie) {
            $movie->thumbnail_url = $movie->thumbnail 
                ? asset('storage/' . $movie->thumbnail) 
                : null;
            return $movie;
        });

        return response()->json($movies);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'thumbnail' => 'nullable|mimes:jpeg,jpg,png|image|max:20480'
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

    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'thumbnail' => 'nullable|mimes:jpeg,jpg,png|image|max:20480',
            'existingThumbnail' => 'nullable|string'
        ]);

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if exists
            if ($movie->thumbnail) {
                Storage::disk('public')->delete($movie->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        } else {
            // Keep existing thumbnail path if no new file uploaded
            $data['thumbnail'] = $request->input('existingThumbnail');
        }

        $movie->update($data);

        $movie->thumbnail_url = $movie->thumbnail 
            ? asset('storage/' . $movie->thumbnail) 
            : null;

        return response()->json($movie);
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        if ($movie->thumbnail) {
            Storage::disk('public')->delete($movie->thumbnail);
        }

        $movie->delete();

        return response()->json(['message' => 'Movie deleted successfully']);
    }
}
