<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $items = Post::with('category')
            ->when($request->filled('search'), function ($query) use ($request) {
                $term = $request->string('search');
                $query->where(fn ($q) => $q->where('title', 'like', "%{$term}%")->orWhere('slug', 'like', "%{$term}%"));
            })
            ->when($request->filled('status'), fn ($query) => $query->where('is_published', $request->input('status') === 'published'))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.posts.index', compact('items'));
    }

    public function create()
    {
        return view('admin.posts.form', ['item' => new Post(), 'categories' => Category::orderBy('name')->get()]);
    }

    public function store(PostRequest $request)
    {
        Post::create($request->prepared());

        return redirect()->route('admin.posts.index')->with('ok', 'Artikel dibuat.');
    }

    public function edit(Post $post)
    {
        return view('admin.posts.form', ['item' => $post, 'categories' => Category::orderBy('name')->get()]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->prepared());

        return redirect()->route('admin.posts.index')->with('ok', 'Artikel diperbarui.');
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('ok', 'Artikel dihapus.');
    }
}
