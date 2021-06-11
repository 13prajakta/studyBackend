<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Getintouch extends Model
{
    protected $fillable = [
        'name', 'email', 'mobile','nationality','language','program',
    ];

    protected $table = 'getin_touch';
}
