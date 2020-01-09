<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Setting;
use Illuminate\Http\Request;

use App\Http\Resources\PostResource;
use Plank\Mediable\Media;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($filter = null)
    {
        if ($filter) { 
            if ($filter['user_id']) {
                return PostResource::collection(Post::where('user_id', $filter['user_id'])->paginate(5));
            }
        } else {
            return PostResource::collection(Post::latest()->paginate(5));
        }
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
            // 'image' => 'required|mimes:jpeg,png,jpg,gif,svg',
            ]
        );

        $post = new Post;

        $now = Carbon::now();
        $day = $nowFormatted = $now->day;
        $month = $now->month;
        $year = $now->year;
        $titleFormatted = str_replace(' ', '', strtolower($request->title));
        $post->slug = $year."/".$month."/".$day."/".$titleFormatted;

        $post->user_id = $request->user_id;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->published = $request->published;
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
        $post->groups()->sync(array_column($request->groups, 'id'));
        $post->save();

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
        $posts = Post::withMedia()->where('published', true)->get();

        // settings
        $settings = Setting::all();
        $newSettings = [];
        foreach ($settings as $setting => $value) {
            $newSettings[$value->key] = json_decode($value->value);
        }

        foreach($posts as $post){
            if ($post->hasMedia('featured_image')) {
                $post->image = $post->firstMedia('featured_image')->basename;
            }
        }

        return view(
            'posts', [
            'posts' => $posts,
            'settings' => $newSettings,
            ]
        );
    }

    public function single($slug = null)
    {
        // get the post where the slug matches
        $post = Post::where('slug', $slug)->get()->first();
        
        // if no post, return 404
        if (!$post) {
            return abort(404);
        }

        // do we have a logged in user?
        $user = Auth::User();


        if ($user) {

            // post is not published, but user is authenticated...redirect to preview page
            if (!$post->published) {
                return redirect('/preview/post/'.$post->id);
            }
        } else {

            // post is not published, and no user, return 404
            if (!$post->published) {
                return abort(404);
            }
        }

        // get site settings
        $settings = Setting::all();
        $newSettings = [];
        foreach ($settings as $setting => $value) {
            $newSettings[$value->key] = json_decode($value->value);
        }

        // get groups for post
        if (count($post->groups()->get()->toArray()) > 0) {

            // if post has groups and user is not authenticated...return 403
            if (!$user) {
                return abort(403);
            }
            $userGroups = $user->groups()->get()->pluck('id')->toArray();
            $postGroups = $post->groups()->get()->pluck('id')->toArray();
            if (count(array_intersect($userGroups, $postGroups)) === 0) {
                return abort(403);
            }
        }

        // get the featured image for the post
        if ($post->hasMedia('featured_image')) {
            $post->image = $post->firstMedia('featured_image')->basename;
        }

        return view('single', ['post' => $post, 'settings' => $newSettings]);
    }

    public function preview(Post $post)
    {
        // check user's groups
        if (count($post->groups()->get()->toArray()) > 0) {
            $user = Auth::User();
            $userGroups = $user->groups()->get()->pluck('id')->toArray();
            $postGroups = $post->groups()->get()->pluck('id')->toArray();

            if (count(array_intersect($userGroups, $postGroups)) === 0) {
                return abort(403);
            }
        }

        if ($post->hasMedia('featured_image')) {
            $post->image = $post->firstMedia('featured_image')->basename;
        }

        return view('preview', compact('post'));
    }

    public function getRevisions(Post $post)
    {
        return response()->json($post->revisionHistory->toArray());
    }
    
    public function attachMedia(Request $request, Post $post)
    {
        $post->attachMedia($request->file, 'featured_image');
        return response()->json(['status' => 'success']);
    }

    public function getPostsForUser(User $user)
    {
        $permissions = $user->getAllPermissions()->pluck('name')->toArray();
        if (!in_array('admin.view.posts', $permissions)) {
            return abort(403);
        }

        if (in_array('admin.view.other.posts', $permissions)) {
            return $this->index(null);
        } else {
            return $this->index([ 'user_id' => $user->id ]);
        }
    
    }
}
