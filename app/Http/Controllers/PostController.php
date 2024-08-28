<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Like;
use App\Http\Requests\PostToggleReactionRequest;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpFoundation\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        try {
            // Optimize the query by eager loading the relationships and counting likes
            $posts = Post::with(['tags', 'likes'])->withCount('likes')->get();
            return response()->json(PostResource::collection($posts));
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => Response::HTTP_NOT_FOUND,
                'message' => 'Model not found',
            ], Response::HTTP_NOT_FOUND);
        } catch (\Throwable $e) {
            return response()->json([
                'status'  => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Like or Unlike a post.
     *
     * @param PostToggleReactionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function react(PostToggleReactionRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $post = Post::findOrFail($request->post_id);
            $user = $request->user();

            $like = $post->likes()->where('user_id', $user->id)->first();

            if ($request->like) {
                if (!$like) {
                    // Like the post
                    $post->likes()->create(['user_id' => $user->id]);
                    $message = 'Post liked successfully';
                } else {
                    $message = 'Post already liked';
                }
            } else {
                if ($like) {
                    // Unlike the post
                    $like->delete();
                    $message = 'Post unliked successfully';
                } else {
                    $message = 'Post not liked yet';
                }
            }

            return response()->json([
                'status'  => Response::HTTP_OK,
                'message' => $message,
            ], Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'status'  => Response::HTTP_NOT_FOUND,
                'message' => 'Post not found',
            ], Response::HTTP_NOT_FOUND);
        } catch (\Throwable $e) {
            return response()->json([
                'status'  => Response::HTTP_INTERNAL_SERVER_ERROR,
                'message' => $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}