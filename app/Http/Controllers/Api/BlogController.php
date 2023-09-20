<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Blog\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;


class BlogController extends Controller
{
    public function index()
    {
        $query = Blog::with('user')->latest();

        if (auth()->id() != 1) // User ID - 1 is the System Admin who can see all the blogs. Otherwise users can see only their blogs.
            $query->where('created_by', auth()->id());

        $blogs = $query->latest()->paginate(10);

        return response(['data' => $blogs], Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'   => 'bail|unique:blogs|required|string|max:255',
            'details' => 'bail|required|min:200'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['error' => $errors], 422);
        }

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $blog = Blog::create($data);

        return response(['data' => new BlogResource($blog)], Response::HTTP_OK);
    }

    public function update(Request $request, $blogId)
    {
        $validator = Validator::make($request->all(), [
            'title'   => ['bail', 'required', 'string', 'max:255', 'unique:blogs,title,' . $blogId],
            'details' => ['bail', 'required', 'min:200']
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json(['error' => $errors], 422);
        }

        $blog = Blog::find($blogId);

        if (!$blog)
            return response()->json(['error' => 'Resource not found'], 404);

        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        $blog->update($data);
        return response(['data' => new BlogResource($blog)], Response::HTTP_OK);
    }

    public function show($blogId)
    {
        $blog = Blog::find($blogId);
        if (!$blog)
            return response()->json(['error' => 'Resource not found'], 404);

        return response(['data' => new BlogResource($blog)], Response::HTTP_OK);
    }

    public function destroy($blogId)
    {
        $blog = Blog::find($blogId);
        
        if (!$blog)
            return response()->json(['error' => 'Resource not found'], 404);

        if(auth()->id() != 1)
            return response()->json(['error' => 'You have no permission to delete this record'], 403);  // Only System Admin can delete the record.

        $blog->delete();    
        return response(['data' => new BlogResource($blog)], Response::HTTP_OK);
    }
}
