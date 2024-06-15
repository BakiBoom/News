<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'title',
        'description',
        'isdeleted',
        'ispublish',
        'publishdate',
        'created_at',
        'updated_at',
        'deleted_at',
        'categoryid',
        'tagid'
    ];

}
