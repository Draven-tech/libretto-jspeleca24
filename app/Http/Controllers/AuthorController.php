<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::with('books')->paginate(15);
        
        if (request()->wantsJson()) {
            return response()->json($authors);
        }
        
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author = Author::create($validated);

        if ($request->wantsJson()) {
            return response()->json($author, 201);
        }

        return redirect()->route('authors.index')->with('success', 'Author created successfully.');
    }

    public function show(Author $author)
    {
        $author->load('books');
        
        if (request()->wantsJson()) {
            return response()->json($author);
        }
        
        return view('authors.show', compact('author'));
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $author->update($validated);

        if ($request->wantsJson()) {
            return response()->json($author);
        }

        return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }

    public function destroy(Author $author)
    {
        $author->delete();

        if (request()->wantsJson()) {
            return response()->json(null, 204);
        }

        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}