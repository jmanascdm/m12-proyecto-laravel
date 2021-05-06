<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $table = 'payments';

    protected $fillable = [
        'id_category', 'id_account', 'level', 'order', 'title', 'description', 'price', 'start_date', 'end_date', 'updated_at', 'updated_by'
    ];
}
