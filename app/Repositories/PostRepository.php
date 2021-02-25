<?php

namespace App\Repositories;

use A17\Twill\Repositories\Behaviors\HandleSlugs;
use A17\Twill\Repositories\Behaviors\HandleMedias;
use A17\Twill\Repositories\Behaviors\HandleFiles;
use A17\Twill\Repositories\Behaviors\HandleRevisions;
use A17\Twill\Repositories\Behaviors\HandleBlocks;
use A17\Twill\Repositories\ModuleRepository;
use App\Models\Post;

class PostRepository extends ModuleRepository
{
    use HandleSlugs, HandleMedias, HandleFiles, HandleRevisions, HandleBlocks;

    public function __construct(Post $model)
    {
        $this->model = $model;
    }

    public function getFormFields($object)
    {
        $fields = parent::getFormFields($object);
        $fields['browsers']['categories'] = $this->getFormFieldsForBrowser($object, 'categories');
        return $fields;
    }

    // implement the afterSave method
    public function afterSave($object, $fields) {
        // or, to save a belongToMany relationship used with the browser field
        $this->updateBrowser($object, $fields, 'categories');
        parent::afterSave($object, $fields);
    }

}
