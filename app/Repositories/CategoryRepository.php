<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends ModuleRepository
{
    use HandleSlugs;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function setNewOrder($ids)
    {
        DB::transaction(function () use ($ids) {
            Category::saveTreeFromIds($ids);
        }, 3);
    }

    public function getAllTree()
    {
        return Category::get()->toTree()->toArray();
    }
}
