<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Programme_tour extends Model
{
    use HasFactory;

    protected $fillable=[
        'id_tour',
        'day',
        'programme',
    ];
}

