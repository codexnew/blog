<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'category', 'tags'])
            ->published()
            ->latest()
            ->paginate(6);

        return view('posts.index', [
            'posts' => $posts,
            'archives' => $this->archiveSidebar(),
        ]);
    }

    public function create()
    {
        return view('posts.create', [
            'categories' => Category::orderBy('name')->get(),
            'tags' => Tag::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:posts,slug'],
            'content' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'status' => ['required', 'in:draft,published'],
            'featured_image' => ['nullable', 'url', 'max:2048'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['exists:tags,id'],
        ]);

        $slug = $data['slug'] ?? Str::slug($data['title']);
        $data['slug'] = $this->uniqueSlug($slug);
        $data['user_id'] = Auth::id();

        $post = Post::create($data);
        $post->tags()->sync($data['tags'] ?? []);

        return redirect()->route('posts.show', $post->slug)->with('success', 'Post created successfully.');
    }

    public function show(Post $post)
    {
        $post->load(['user', 'category', 'tags', 'comments.user']);

        if ($post->status !== 'published' && (!Auth::check() || Auth::id() !== $post->user_id)) {
            abort(404);
        }

        $relatedPosts = Post::with(['category', 'tags'])
            ->published()
            ->where('id', '!=', $post->id)
            ->where(function ($query) use ($post) {
                $query->where('category_id', $post->category_id)
                    ->orWhereHas('tags', function ($tagQuery) use ($post) {
                        $tagQuery->whereIn('tags.id', $post->tags->pluck('id'));
                    });
            })
            ->latest()
            ->take(4)
            ->get();

        return view('posts.show', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
            'archives' => $this->archiveSidebar(),
        ]);
    }

    public function edit(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403);
        }

        return view('posts.edit', [
            'post' => $post,
            'categories' => Category::orderBy('name')->get(),
            'tags' => Tag::orderBy('name')->get(),
        ]);
    }

    public function update(Request $request, Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403);
        }

        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:posts,slug,' . $post->id],
            'content' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'status' => ['required', 'in:draft,published'],
            'featured_image' => ['nullable', 'url', 'max:2048'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['exists:tags,id'],
        ]);

        $slug = $data['slug'] ?? Str::slug($data['title']);
        $data['slug'] = $this->uniqueSlug($slug, $post->id);

        $post->update($data);
        $post->tags()->sync($data['tags'] ?? []);

        return redirect()->route('posts.show', $post->slug)->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post)
    {
        if (Auth::id() !== $post->user_id) {
            abort(403);
        }

        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Post deleted successfully.');
    }

    public function archive(int $year, int $month)
    {
        $posts = Post::with(['user', 'category', 'tags'])
            ->published()
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->latest()
            ->paginate(6);

        return view('posts.archive', [
            'posts' => $posts,
            'archives' => $this->archiveSidebar(),
            'year' => $year,
            'month' => $month,
        ]);
    }

    private function uniqueSlug(string $baseSlug, ?int $ignoreId = null): string
    {
        $slug = Str::slug($baseSlug);
        $original = $slug;
        $counter = 1;

        while (Post::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $original . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    private function archiveSidebar()
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'sqlite') {
            return Post::published()
                ->selectRaw("CAST(strftime('%Y', created_at) as integer) as year, CAST(strftime('%m', created_at) as integer) as month, COUNT(*) as post_count")
                ->groupByRaw("strftime('%Y', created_at), strftime('%m', created_at)")
                ->orderByRaw("strftime('%Y', created_at) desc, strftime('%m', created_at) desc")
                ->get();
        }

        return Post::published()
            ->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as post_count')
            ->groupByRaw('YEAR(created_at), MONTH(created_at)')
            ->orderByRaw('YEAR(created_at) desc, MONTH(created_at) desc')
            ->get();
    }
}
