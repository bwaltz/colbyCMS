<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = $request->user();

        $roles = $user->getRoleNames()->toArray();
        // dd($roles);

        if (in_array('superAdmin', $roles) || in_array('admin', $roles) || in_array('editor', $roles) || in_array('author', $roles)) {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/');
        }
    }
}
