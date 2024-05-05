<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place_tour extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'id_guide'
    ];


    public function list()
    {
        return $this->hasMany(Tour::class);
    }
}
