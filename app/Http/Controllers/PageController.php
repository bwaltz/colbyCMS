<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Page;
use Illuminate\Http\Request;
use App\Http\Resources\PageResource;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // retrieve JSON formatted collection of all of the stored posts
        return PageResource::collection(Page::latest()->paginate(5));
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
            'slug' => 'required',            
            ]
        );

        $page = new Page;

        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $name = str_slug($request->title).'.'.$image->getClientOriginalExtension();
        //     $destinationPath = public_path('/uploads/posts');
        //     $imagePath = $destinationPath . "/" . $name;
        //     $image->move($destinationPath, $name);
        //     $post->image = $name;
        // }

        $page->user_id = $request->user_id;
        $page->title = $request->title;
        $page->body = $request->body;
        $page->slug = $request->slug;
        $page->groups()->sync(array_column($request->groups, 'id'));
        $page->save();
        

        return new PageResource($page);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Page $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        // return a single instance of a post in JSON
        return new PageResource($page);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Page $page
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
     * @param  \App\Page                $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {

        $this->validate(
            $request, [
            'title' => 'required',
            'body' => 'required',
            'slug' => 'required',
            'published' => 'required',
            ]
        );
        $page->update($request->only(['title', 'body', 'slug', 'published']));
        $page->groups()->sync(array_column($request->groups, 'id'));
        $page->save();

        return new PageResource($page);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Page $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $page->delete();
        return response()->json(null, 204);
    }

    public function all()
    {
        return view(
            'landing', [
            'pages' => Page::latest()->paginate(5)
            ]
        );
    }

    // public function single($slug = null)
    // {
    //     $page = Page::where('slug', $slug)->get()->first();

    //     if (!$page) {
    //         return abort(404);
    //     }
    //     // if (!$page || $page->published === 0) {
    //     //     return abort(404);
    //     // }

    //     if (!$page->published) {
    //         return redirect('/preview/page/'.$page->id);
    //     }

    //     if (count($page->groups()->get()->toArray()) > 0) {
    //         $user = Auth::User();
    //         $userGroups = $user->groups()->get()->pluck('id')->toArray();
    //         $pageGroups = $post->groups()->get()->pluck('id')->toArray();

    //         if (count(array_intersect($userGroups, $pageGroups)) === 0) {
    //             return abort(403);
    //         }
    //     }

    //     return view('single', compact('page'));
    // }

    public function preview(Page $page)
    {

        if (count($page->groups()->get()->toArray()) > 0) {
            $user = Auth::User();
            $userGroups = $user->groups()->get()->pluck('id')->toArray();
            $pageGroups = $page->groups()->get()->pluck('id')->toArray();

            if (count(array_intersect($userGroups, $pageGroups)) === 0) {
                return abort(403);
            }
        }
        return view('page_preview', compact('page'));
    }

    public function getPage($slug = null)
    {
        
        $page = Page::where('slug', $slug)->get()->first();

        if (!$page) {
            return abort(404);
        }

        $user = Auth::User();

        // post is published and user is authenticated
        if (!$page->published === 0 && $user) {
            return redirect('/preview/page/'.$page->id);
        }

        if (count($page->groups()->get()->toArray()) > 0) {
            if (!$user) {
                return abort(403);
            }

            $userGroups = $user->groups()->get()->pluck('id')->toArray();
            $pageGroups = $post->groups()->get()->pluck('id')->toArray();

            if (count(array_intersect($userGroups, $pageGroups)) === 0) {
                return abort(403);
            }
        }
        return view('page', compact('page'));
    }

    public function getRevisions(Page $page)
    {
        return response()->json($page->revisionHistory->toArray());
    }
}