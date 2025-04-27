<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    public function index()
    {
        return Movie::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|mimes:jpeg,jpg|image|max:20480' 
        ]);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        }

        return Movie::create($data);
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'thumbnail' => 'nullable|mimes:jpeg,jpg|image|max:20480',  
            'existingThumbnail' => 'nullable|string'
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($movie->thumbnail) {
                Storage::disk('public')->delete($movie->thumbnail);
            }
            $data['thumbnail'] = $request->file('thumbnail')->store('thumbnails', 'public');
        } else {
            $data['thumbnail'] = $request->input('existingThumbnail');
        }

        $movie->update($data);
        return $movie;
    }

    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);
        if ($movie->thumbnail) {
            Storage::disk('public')->delete($movie->thumbnail);
        }
        $movie->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
