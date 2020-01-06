<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Plank\Mediable\Mediable;
use Lecturize\Taxonomies\Traits\HasTaxonomies;

class Post extends Model
{
    use RevisionableTrait;
    use SoftDeletes;
    use Mediable;
    use HasTaxonomies;
    

    protected $revisionCreationsEnabled = true;
    protected $fillable = ['user_id', 'title', 'body', 'image', 'slug', 'published', 'groups'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function groups()
    {
        return $this->belongsToMany('App\Group', 'group_post', 'group_id', 'post_id');
    }
}
