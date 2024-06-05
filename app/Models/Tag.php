<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
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
        'isdeleted',
        'publishdate',
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}
