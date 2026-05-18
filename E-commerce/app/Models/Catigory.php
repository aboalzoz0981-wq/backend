<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catigory extends Model
{
    protected $guarded = [];
    public function profiles()
    {
        return $this->belongsToMany(Profile::class, 'catigories_profiles');
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

}
