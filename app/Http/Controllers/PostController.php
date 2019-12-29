<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use Plank\Mediable\Media;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // retrieve JSON formatted collection of all of the stored posts
        return PostResource::collection(Post::latest()->paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request, [
            'title' => 'required',
            'body' => 'required',
            'user_id' => 'required',            
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
            ]
        );

        $post = new Post;

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $name = str_slug($request->title).'.'.$image->getClientOriginalExtension();
        //     $destinationPath = public_path('/uploads/posts');
        //     $imagePath = $destinationPath . "/" . $name;
        //     $image->move($destinationPath, $name);
        //     $post->image = $name;
        // }

        $post->user_id = $request->user_id;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->save();

        //Store Image
        if($request->hasFile('image') && $request->file('image')->isValid()) {
            $product->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // return a single instance of a post in JSON
        return new PostResource($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Post                $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $this->validate(
            $request, [
            'title' => 'required',
            'body' => 'required',
            'slug' => 'required',
            'published' => 'required',
            ]
        );
        $post->update($request->only(['title', 'body', 'slug', 'published']));

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(null, 204);
    }

    public function all()
    {
        return view(
            'landing', [
            'posts' => Post::latest()->paginate(5)
            ]
        );
    }

    public function single($slug = null)
    {
        
        $post = Post::where('slug', $slug)->get()->first();
        // dd($post);
        if (!$post) {
            return abort(404);
        }
        return view('single', compact('post'));
    }

    public function preview(Post $post)
    {
        return view('preview', compact('post'));
    }

    public function getRevisions(Post $post)
    {
        return response()->json($post->revisionHistory->toArray());
    }
    
    public function attachMedia(Request $request, Post $post)
    {
        // $media = Media::whereBasename($request->file);
        // dd($media);
        $post->attachMedia($request->file, 'featured_image');
        return response()->json($post->revisionHistory->toArray());
    }
}
