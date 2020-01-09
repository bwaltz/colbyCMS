<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $user = Auth::User();
        if (!$user) {
            return redirect('/');
        }
        $roles = $user->getRoleNames()->toArray();

        if (in_array('superAdmin', $roles) || in_array('admin', $roles) || in_array('editor', $roles) || in_array('author', $roles)) {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/');
        }
    }
    
    public function landing()
    {
        // get all settings from settings model
        $settings = Setting::all();
        
        $newSettings = [];
        foreach ($settings as $setting => $value) {
            $newSettings[$value->key] = json_decode($value->value);
        }

        return view(
            'landing', [
            'settings' => $newSettings,
            ]
        );
    }
}
