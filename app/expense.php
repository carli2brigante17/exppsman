<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class expense extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'categoryname','amount','entrydate','uid', 
    ];
}
