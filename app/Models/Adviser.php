<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Adviser extends Authenticatable
{
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
}
