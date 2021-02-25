<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\PageRepository;


class PageController extends Controller
{
    public function __construct(PageRepository $repository) {
        $this->repository = $repository;
    }

    public function show($slug) {

        $page = $this->repository->forSlug($slug);
        abort_unless($page, 404, 'Page');

        return view('frontend.page', compact('page'));
    }
}
