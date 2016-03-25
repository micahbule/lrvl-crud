<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fruit extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'price'];

    protected $dates = ['deleted_at'];
}
