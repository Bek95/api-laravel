<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return response()->json($posts);
    }

    public function show(Post $post)
    {
        return response()->json($post);
    }

    public function store(PostRequest $request)
    {
        Post::create($request->validated());

        return response()->json(
            ['message' => 'Post created successfully'],
            201
        );
    }

    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->validated());

        return response()->json(['message' => 'Post updated successfully'], 200);
    }
}
