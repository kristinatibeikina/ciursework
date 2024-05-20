<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booked_tours extends Model
{
    use HasFactory;

    public $fillable=[
        'id_tour',
        'count_children',
        'count_adults',
        'wishes',
        'response',
        'id_status_application',
        'id_user',
        'tel',
        'email',
        'date_application'

    ];
}
