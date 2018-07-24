<?php

namespace App\Http\Controllers;

use App\Post;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        $user = auth()->user();

        if ($post->isLikedBy($user)) {
            $user->unlike($post);
        } else {
            $user->like($post);
        }

        return response()->json([
            'likes_count' => $post->likesCount(),
            'is_liked' => $post->isLikedBy($user)
        ]);
    }
}
