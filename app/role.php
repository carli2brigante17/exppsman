<?php

namespace App;



use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class role extends Model
{
    protected $table = 'role';
    use SoftDeletes;
    protected $fillable = [
        'role', 'description', 
    ];

}
