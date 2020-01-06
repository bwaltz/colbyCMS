<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Plank\Mediable\Mediable;
use Lecturize\Taxonomies\Traits\HasTaxonomies;


class Page extends Model
{
    use RevisionableTrait;
    use SoftDeletes;
    use Mediable;
    use HasTaxonomies;

    protected $revisionCreationsEnabled = true;

    protected $dates = [
        'published_on',
    ];

    protected $fillable = ['user_id', 'title', 'body', 'slug', 'published'];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function groups()
    {
        return $this->belongsToMany('App\Group', 'group_page', 'page_id', 'group_id');
    }
}
