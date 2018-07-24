<?php

namespace App\Http\Controllers;

use App\Post;
use App\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ViewController extends Controller
{
    public function store(Request $request, Post $post) : JsonResponse
    {
        dd($user = auth()->user());

        if ($post->isViewedByUser($user) || $post->isViewedByIp($request->ip())) {

            return;
        }

        View::create([
            'post_id' => $post->id,
            'user_id' => $user->id,
            'user_ip' => $request->ip()
        ]);

        return response()->json([
            'views_count' => $post->fresh()->viewsCount(),
        ]);
    }
}
