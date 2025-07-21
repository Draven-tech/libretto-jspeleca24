<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::with('books')->paginate(15);
        
        if (request()->wantsJson()) {
            return response()->json($genres);
        }
        
        return view('genres.index', compact('genres'));
    }

    public function create()
    {
        return view('genres.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:genres',
        ]);

        $genre = Genre::create($validated);

        if ($request->wantsJson()) {
            return response()->json($genre, 201);
        }

        return redirect()->route('genres.index')->with('success', 'Genre created successfully.');
    }

    public function show(Genre $genre)
    {
        $genre->load('books');
        
        if (request()->wantsJson()) {
            return response()->json($genre);
        }
        
        return view('genres.show', compact('genre'));
    }

    public function edit(Genre $genre)
    {
        return view('genres.edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:genres,name,'.$genre->id,
        ]);

        $genre->update($validated);

        if ($request->wantsJson()) {
            return response()->json($genre);
        }

        return redirect()->route('genres.index')->with('success', 'Genre updated successfully.');
    }

    public function destroy(Genre $genre)
    {
        $genre->delete();

        if (request()->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('genres.index')->with('success', 'Genre deleted successfully.');
    }
}