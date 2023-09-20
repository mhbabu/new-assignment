<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function comment(Request $request, $blogId){
       $request->validate([
        'comment' => 'bail|required|string|min:5'
       ]);

       $comment = new Comment();
       $comment->blog_id = $blogId;
       $comment->user_id = auth()->id();
       $comment->comment = $request->input('comment');
       $comment->save();

       return back()->with('success', 'You have commented successfully.');
    }
}
