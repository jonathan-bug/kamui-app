<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    protected $fillable = [
        'title',
        'priority',
        'until',
        'repeat',
        'last',
        'last',
        'streak',
        'status'
    ];
}
