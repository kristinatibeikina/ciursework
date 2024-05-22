<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable=[
        'count_stars',
        'comment',
        'date_published',
        'id_user',
        'id_tour',
        'photo'
    ];

}
