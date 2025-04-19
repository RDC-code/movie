<?php

// app/Http/Controllers/MovieController.php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::all();
        return response()->json(['movies' => $movies]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'director' => 'required|string|max:255',
            'release_year' => 'required|digits:4',
        ]);

        $movie = Movie::create([
            'title' => $request->title,
            'director' => $request->director,
            'release_year' => $request->release_year,
        ]);

        return response()->json(['message' => 'Movie added successfully!', 'movie' => $movie], 201);
    }
}
