<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fav;
use App\Models\Rental;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasFactory;

    public $timestamps = false;

    public function isAdmin(){
        return $this->type == 3;
    }

    public function isSeller(){
        return $this->type == 2;
    }

    public function isRegistered(){
        return $this->type == 1;
    }

    public function favs(){
        return $this->hasMany(Fav::class);
    }

    public function rental(){
        return $this->hasMany(Rental::class);
    }
}
