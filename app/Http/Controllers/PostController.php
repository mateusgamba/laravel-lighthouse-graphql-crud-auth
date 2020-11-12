<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $posts = Post::with('user:id,name')->get();
        return response()->json($posts, 200);
    }

    /**
     * @param  Post  $post
     * @return JsonResponse
     */
    public function show(Post $post): JsonResponse
    {
        $post = Post::with('user:id,name')->find($post->id);
        return response()->json($post, 200);
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $post = Post::create($request->all());
        return response()->json($post, 201);
    }

    /**
     * @param  Request  $request
     * @param  Post  $post
     * @return JsonResponse
     */
    public function update(Request $request, Post $post): JsonResponse
    {
        $post->update($request->all());
        return response()->json($post, 200);
    }

    /**
     * @param  Post  $post
     * @return JsonResponse
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->delete();
        return response()->json(null, 204);
    }
}
