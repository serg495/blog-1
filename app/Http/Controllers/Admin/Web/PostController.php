<?php

namespace App\Http\Controllers\Admin\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRequest;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'desc')->paginate();

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(StoreRequest $request)
    {
        $post = Post::create($request->all());
        $post->addMediaFromRequest('thumbnail')->toMediaCollection('images');

        return redirect()->route('posts.show', $post);
    }

    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(StoreRequest $request, Post $post)
    {
        $post->update($request->all());

        $post->clearMediaCollection('images');
        $post->addMediaFromRequest('thumbnail')->toMediaCollection('images');

        return redirect()->route('posts.show', $post);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return redirect()->route('posts.index');
    }
}
