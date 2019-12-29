<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Venturecraft\Revisionable\RevisionableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Plank\Mediable\Mediable;

class Post extends Model
{
    use RevisionableTrait;
    use SoftDeletes;
    use Mediable;
    

    protected $revisionCreationsEnabled = true;
    protected $fillable = ['user_id', 'title', 'body', 'image', 'slug', 'published'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
