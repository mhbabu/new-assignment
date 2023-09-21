<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\StoreBlogRequest;
use App\Http\Requests\Blog\UpdateBlogRequest;
use Illuminate\Support\Str;
use App\Models\Blog;
use Brian2694\Toastr\Facades\Toastr;

class BlogController extends Controller
{
    public function index()
    {
        $query = Blog::query();

        // User ID - 1 is the System Admin who can see all the blogs. Otherwise users can see only their creating blogs.
        if (auth()->id() != 1)
            $query->where('created_by', auth()->id());

        $data['blogs'] = $query->latest()->paginate(9);

        return view("backend.blog.index", $data);
    }

    public function create()
    {

        return view("backend.blog.create");
    }

    public function store(StoreBlogRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);
        Blog::create($data);
        Toastr::success('Blog created successfully');
        return redirect()->route('blogs.index');
    }

    public function edit(Blog $blog)
    {
        $data['blog'] = $blog;
        return view("backend.blog.edit", $data);
    }

    public function update(UpdateBlogRequest $request, Blog $blog)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);
        Blog::find($blog->id)->update($data);
        Toastr::success('Blog updated successfully');
        return redirect()->route('blogs.index');
    }

    public function delete(Blog $blog)
    {
        $blog->delete();
        Toastr::success('Blog deleted successfully');
        return back();
    }
}
