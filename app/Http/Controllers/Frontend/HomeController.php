<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        
        $data['posts'] = Blog::latest()->paginate(10);
        return view("frontend.index", $data);
    }
}
