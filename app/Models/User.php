<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fav;
use App\Models\Rental;

class User extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function favs(){
        return $this->hasMany(Fav::class);
    }

    public function rental(){
        return $this->hasOne(Rental::class);
    }
}
