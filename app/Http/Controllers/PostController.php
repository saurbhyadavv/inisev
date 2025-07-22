<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Website;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function store(PostRequest $request): JsonResponse
    {
        $website = Website::findOrFail($request->website_id);

        $post = Post::create([
            'website_id' => $website->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Dispatch event for background processing
        event(new PostCreated($post));

        return response()->json([
            'message' => 'Post created successfully',
            'data' => $post
        ], 201);
    }
}
