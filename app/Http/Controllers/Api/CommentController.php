<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Comment\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;


class CommentController extends Controller
{
    public function comment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'blog_id' => 'bail|required|exists:blogs,id',
            'comment' => 'bail|required|string|max:255'
        ],[],[
            'blog_id' => 'post'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['error' => $errors], 422);
        }

        $comment = new Comment();
        $comment->blog_id = $request->input('blog_id');
        $comment->user_id = auth()->id();
        $comment->comment = $request->input('comment');
        $comment->save();

        return response(['data' => new CommentResource($comment)], Response::HTTP_OK);
    }
}
