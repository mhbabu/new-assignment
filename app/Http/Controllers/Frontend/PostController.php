<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function postdetails(Blog $blog){
        $data['post'] = $blog->with('user')->first();
        $data['comments'] = Comment::where('blog_id', $blog->id)->paginate(5);
        return view("frontend.post-details", $data);
    }
}
