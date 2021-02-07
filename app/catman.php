<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class catman extends Model
{
    protected $table = 'category';
    use SoftDeletes;
    
    protected $fillable = [
        'categoryname', 'description', 'created_at',
    ];
}
