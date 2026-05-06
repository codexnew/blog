<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        return view('tags.index', [
            'tags' => Tag::latest()->paginate(15),
        ]);
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tags,name'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:tags,slug'],
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        Tag::create($data);

        return redirect()->route('tags.index')->with('success', 'Tag created successfully.');
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:tags,name,' . $tag->id],
            'slug' => ['nullable', 'string', 'max:255', 'unique:tags,slug,' . $tag->id],
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $tag->update($data);

        return redirect()->route('tags.index')->with('success', 'Tag updated successfully.');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully.');
    }
}
