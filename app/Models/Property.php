<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Rental;
use App\Models\Image;
use App\Models\Room;
use App\Models\Fav;
use App\Models\Bill;

class Property extends Model
{
    use HasFactory;

    public function favs(){
        return $this->hasMany(Fav::class);
    }

    public function rentals(){
        return $this->hasMany(Rental::class);
    }

    public function bills(){
        return $this->hasMany(Bill::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }

    public function incidences(){
        return $this->hasMany(Incidence::class);
    }
}
