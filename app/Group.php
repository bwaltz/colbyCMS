<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Kalnoy\Nestedset\NodeTrait;
use \Illuminate\Database\Eloquent\SoftDeletes;

class Group extends Model
{
    use SoftDeletes;
    use NodeTrait;
    protected $fillable = array('name', 'description', 'parent_id');

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Post');
    }
    
    public function pages()
    {
        return $this->belongsToMany('App\Post');
    }
}