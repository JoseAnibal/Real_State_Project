<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Rental;
use App\Models\Image;
use App\Models\Room;
use App\Models\Fav;

class Property extends Model
{
    use HasFactory;

    public function favs(){
        return $this->hasMany(Fav::class);
    }

    public function users(){
        return $this->hasManyThrough(User::class,Rental::class);
    }

    public function bills(){
        return $this->hasManyThrough(Bill::class,Rental::class);
    }

    public function incidences(){
        return $this->hasManyThrough(Incidence::class,Rental::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function rooms(){
        return $this->hasMany(Room::class);
    }
}
