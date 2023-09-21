<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BlogListDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Blog\StoreBlogRequest;
use App\Http\Requests\Blog\UpdateBlogRequest;
use Illuminate\Support\Str;
use App\Models\Blog;
use Brian2694\Toastr\Facades\Toastr;

class BlogController extends Controller
{
    public function index(BlogListDataTable $blogListDataTable)
    {
        return $blogListDataTable->render("backend.blog.index");
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
