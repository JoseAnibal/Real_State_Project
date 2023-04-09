<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['property_id','image_url'];

    public function property(){
        return $this->belongsTo(Property::class);
    }
}
