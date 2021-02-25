<?php

namespace App\Http\Controllers\Admin;

use A17\Twill\Http\Controllers\Admin\ModuleController;


class PageController extends ModuleController
{
    protected $moduleName = 'pages';

    protected function getPermalinkBaseUrl()
    {
        return request()->getScheme() . '://' . config('app.url') . '/'
            . ($this->moduleHas('revisions') ? '{preview}/' : '');
    }


}
