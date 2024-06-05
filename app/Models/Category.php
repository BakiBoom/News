<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
        'ispublish',
        'isdeletd',
        'publishdate',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
