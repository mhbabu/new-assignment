<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function postdetails($slug){
        $data['post'] = Blog::where('slug', $slug)->with('user')->first();
        $data['comments'] = Comment::where('blog_id', $data['post']->id)->paginate(5);
        return view("frontend.post-details", $data);
    }
}
