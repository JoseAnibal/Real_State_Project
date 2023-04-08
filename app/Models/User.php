<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fav;

class User extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function favs(){
        return $this->hasMany(Fav::class);
    }
}
