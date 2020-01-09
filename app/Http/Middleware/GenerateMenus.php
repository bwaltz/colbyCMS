<?php

namespace App\Http\Middleware;

use Closure;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        \Menu::make(
            'mainNav', function ($menu) {
                $menu->add('Home', ['route'  => 'home']);
                $menu->add('Admissions', ['route'  => 'admissions.home']);
                $menu->admissions->add('Home', ['route'  => 'admissions.home']);
                $menu->admissions->add('Page 1', ['url'  => 'admissions/page/1']);
                $menu->add('Posts', ['route'  => 'posts']);
                $menu->add('Form Page', ['url'  => 'form/page']);
                $menu->add('Test Page 1', ['url'  => 'test/page/1']);
                $menu->add('Contact', ['route' => 'contact']);
            }
        );
        
        
        \Menu::make(
            'postSidebarNav', function ($menu) {
                $menu->add('Home', ['route'  => 'homepage', 'class' => 'awesome-li']);
                $menu->add('Admissions', ['url' => 'admissions', 'class' => 'awesome-li']);
                $menu->admissions->add('Colby Commitment', ['url' => 'admissions/commitment', 'class' => 'awesome-li']);
                $menu->admissions->add('Deadlines', ['url' => 'admissions/deadlines', 'class' => 'awesome-li']);
                $menu->admissions->add('ThisColbyLife', ['url' => 'admissions/thiscolbylife', 'class' => 'awesome-li']);
                $menu->add('Posts', ['route'  => 'posts', 'class' => 'awesome-li']); 
                $menu->add('Contact', ['route' => 'contact', 'class' => 'awesome-li']);
            }
        );
        
        return $next($request);
    }
}
