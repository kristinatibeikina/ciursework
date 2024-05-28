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
        'photo',
        'legal_age',
        'enabled',
        'id_region',
        'id_status',
        'id_guid',
        'id_housing',
    ];






    public function getPhotosAttribute($value)
    {
        return json_decode($value, true);
    }


}
