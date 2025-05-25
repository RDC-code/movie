<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
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

    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png|max:20480',
            'existingThumbnail' => 'nullable|string'
        ]);

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail if it exists
            if ($movie->thumbnail) {
                Storage::disk('public')->delete($movie->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        } elseif (isset($data['existingThumbnail'])) {
            $data['thumbnail'] = $data['existingThumbnail'];
        }

        unset($data['existingThumbnail']); // Clean up unnecessary field before update

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
