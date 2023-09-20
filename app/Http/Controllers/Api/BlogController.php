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
    public function index(){

        $query = Blog::with('user')->latest();

        if(auth()->id() != 1) // User ID - 1 is the System Admin who can see all the blogs. Otherwise users can see only their blogs.
            $query->where('created_by', auth()->id());
        
        $blogs= $query->latest()->paginate(9);    

        return response(['data' => $blogs], Response::HTTP_OK);
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(),[
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

    public function update(Request $request, Blog $blog){

        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);
        Blog::find($blog->id)->update($data);
        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully.');
    }
}
