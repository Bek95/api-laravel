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
        //on peut rajouter aussi des filtres et des options de tri si nécessaire
        $posts = Post::paginate(10); // 10 posts par page

        return response()->json([
            'data' => $posts->items(),
            'pagination' => [
                'total' => $posts->total(),
                'per_page' => $posts->perPage(),
                'current_page' => $posts->currentPage(),
                'last_page' => $posts->lastPage(),
                'next_page_url' => $posts->nextPageUrl(),
                'prev_page_url' => $posts->previousPageUrl(),
            ]
        ]);
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
            if ($post) {
                $post->update($request->validated());

                return response()->json(['message' => 'Post updated successfully'], 200);
            } else {
                return response()->json(['message' => 'Post not found'], 404);
            }

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
