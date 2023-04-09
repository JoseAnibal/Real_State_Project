<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Property;
use App\Models\Bill;
use App\Models\Incidence;

class Rental extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function property(){
        return $this->belongsTo(Property::class,'property_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function bills(){
        return $this->hasMany(Bill::class);
    }

    public function incidences(){
        return $this->hasMany(Incidence::class);
    }
}
