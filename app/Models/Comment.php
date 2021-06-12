<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    public static $rules = array(
        'comment' => 'required',
        'commentname' => 'required',
        'post_id' => 'required'
    );
}
