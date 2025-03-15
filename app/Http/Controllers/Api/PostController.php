<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
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
        try {
            $post = Post::create($request->validated());

            return response()->json([
                'message' => 'Post created successfully',
                'data' => $post
            ],
                201,
            );
        } catch (\Exception $e) {
            return response()->json(['message' => 'Post cannot be created ' . $e->getMessage()], 400);
        }
    }

    public function update(PostUpdateRequest $request, Post $post)
    {
        try {
            $post->update($request->validated());

            return response()->json(['message' => 'Post updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Post cannot be updated ' . $e->getMessage()], 400);
        }
    }

    public function destroy(Post $post)
    {
        try {
            $post->delete();

            return response()->json(['message' => 'Post deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Post cannot be deleted ' . $e->getMessage()], 400);
        }
    }
}
