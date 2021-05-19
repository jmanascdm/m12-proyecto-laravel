<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';

    protected $fillable = [
        'category', 'created_by', 'created_at', 'updated_by', 'updated_at',
    ];
}
