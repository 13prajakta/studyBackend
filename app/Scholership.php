<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scholership extends Model
{
    protected $fillable = [
        'scholership_name','detail',
    ];

    protected $table = 'scholerships';
}
