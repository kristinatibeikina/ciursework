<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'description',
        'price',
        'date_start',
        'date_end',
        'legal_age',
        'id_housing',
        'place_tour_id',
        'id_status',
        //'id_feedback'
    ];


    public function list()
    {
        return $this->only(Feedback::all());
    }

}
