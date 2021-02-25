<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\PostRepository;


class PostController extends Controller
{
    public function __construct(PostRepository $repository) {
        $this->repository = $repository;
    }

    public function show($slug) {

        // $created_at = Carbon::parse($this->repository->get()->first()->created_at);
        $post = $this->repository->forSlug($slug);
        abort_unless($post, 404, 'Post');

        return view('frontend.post', compact('post'));
    }
}
