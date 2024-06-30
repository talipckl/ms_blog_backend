<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\Post\PostIndexResource;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Routing\Controller;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $posts = Post::query()->orderByDesc('id')->paginate(20);

            return PostIndexResource::collection($posts);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Internal Error!',
                'sign_in_error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, Authenticatable $user)
    {
        try {
            $post_data = $request->only([
                'category_id',
                'title',
                'content',
            ]);
            $post_data['user_id'] = $user->id;
            $post = Post::create($post_data);

            return PostResource::make($post);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Internal Error!',
                'log' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        try {
            $post = Post::where('slug', $slug)->first();

            if (!$post) {
                return response()->json([
                    'status' => false,
                    'message' => 'Post Not Found!',
                ], 404);
            }
            return PostResource::make($post);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Internal Error!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function update(UpdatePostRequest $request, $post_id)
    {
        try {
            $post = Post::findOrFail($post_id);
            $req_post = $request->only([
                'category_id',
                'slug',
                'title',
                'content',
            ]);
            $post->update($req_post);

            return PostResource::make($post);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Post Not Found!',
                'log' => $e->getMessage()
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Internal Error!',
                'sign_in_error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($post_id)
    {
        try {
            $post = Post::findOrFail($post_id);
            $post->delete();

            return response()->json([
                'status' => true,
                'message' => 'Success deleted',
            ], 200);

        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Post Not Found!',
                'log' => $e->getMessage()
            ], 404);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Internal Error!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
