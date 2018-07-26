<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Requests\Post\UpdateRequest;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\PostResource;
use App\Http\Controllers\Controller;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate();

        return PostResource::collection($posts);
    }

    public function store(StoreRequest $request)
    {
        $post = Post::create($request->all());
        $post->addMediaFromRequest('thumbnail')->toMediaCollection('images');

        return new PostResource($post);
    }

    public function show(Post $post)
    {
        return new PostResource($post);
    }

    public function update(UpdateRequest $request, Post $post)
    {
        $image = $request->file('thumbnail');

        $post->update($request->all());

        if (isset($image)) {
            $post->clearMediaCollection('images');
            $post->addMediaFromRequest('thumbnail')->toMediaCollection('images');
        }

        return new PostResource($post);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return new PostResource($post);
    }
}
