<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('created_by',auth()->user()->id)->get();
        return $this->successResponse($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|unique:posts,title',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors());
        }

        $validatedData = $validator->validated();

        $post = Post::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'created_by' => auth()->user()->id,
        ]);

        return $this->successResponse($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        if(!$post) {
            return $this->errorResponse('no post found of that id');
        }
        if ($post->created_by !== auth()->user()->id) {
            return $this->errorResponse('You do not have access to this post');
        } 
        return $this->successResponse($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if(!$post) {
            return $this->errorResponse('no post found of that id');
        }
        else if ($post->created_by !== auth()->user()->id) {
            return $this->errorResponse('You do not have access to this post');
        } else {
            $validator = Validator::make($request->all(), [
                'title' => 'nullable|string|unique:posts,title,' . $post->id,
                'content' => 'nullable|string',
            ]);
    
            if ($validator->fails()) {
                return $this->errorResponse($validator->errors());
            }
    
            $validatedData = $validator->validated();
    
            $post->update([
                'title' => $validatedData['title'],
                'content' => $validatedData['content'],
                'created_by' => auth()->user()->id,
            ]);
    
            return $this->successResponse($post);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if(!$post) {
            return $this->errorResponse('no post found of that id');
        }
        if ($post->created_by !== auth()->user()->id) {
            return $this->errorResponse('You do not have access to this post');
        } 
        $post->delete();
        return $this->successResponse('post deleted successfully');
    }
}
