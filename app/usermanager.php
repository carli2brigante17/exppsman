<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\SoftDeletes;
class usermanager extends Model
{
    protected $table = 'users';
    
    use SoftDeletes;
    protected $fillable=[ 
        'name',
        'role',
        'email',
       'password'

    ];
}
