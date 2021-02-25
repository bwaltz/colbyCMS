<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;
use App\Repositories\PostRepository;
use App\Repositories\CategoryRepository;

use Carbon\Carbon;

class PostController extends ModuleController
{
    protected $moduleName = 'posts';

    protected function getPermalinkBaseUrl()
    {
        $created_at = Carbon::now();
        if (count($this->repository->get()) > 0) {
            $created_at = Carbon::parse($this->repository->get()->first()->created_at);

        }

        return request()->getScheme() . '://' . config('app.url') . '/'
                . ($this->moduleHas('revisions') ? '{preview}/' : '')
                . 'post/'
                . $created_at->year. '/'  . $created_at->format('m') .  '/'  . $created_at->format('d') . '/';

    }

    protected function formData($request)
    {
        return [
            'categories' => app()->make(CategoryRepository::class)->getAllTree()
        ];
    }
}
