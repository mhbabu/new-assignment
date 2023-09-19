<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index(){

        $data['blogs'] = Blog::paginate(10);
        return view("admin.blog.index", $data);
    }

    public function create(){

        return view("admin.blog.create");
    }

    public function store(StoreBlogRequest $request){

        Blog::create($request->validated());
        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }

    public function edit(Blog $blog){

        $data['blog'] = $blog;
        return view("admin.blog.edit", $data);
    }

    public function update(UpdateBlogRequest $request, Blog $blog){

        Blog::find($blog->id)->update($request->validated());
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }
}
