<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'postname' => 'required',
        'content' => 'required'
    );

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

}
