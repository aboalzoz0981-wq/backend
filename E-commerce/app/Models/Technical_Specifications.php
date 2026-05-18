<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technical_Specifications extends Model
{
    protected $guarded = [];

    public function values(){
        return $this->hasMany(Value_attribute::class);
    }
}
