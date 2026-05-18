<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Value_attribute extends Model
{
    protected $guarded = [];

    public function technicals(){
        return $this->belongsTo(Technical_Specifications::class);
    }

    
    public function products(){
        return $this->belongsToMany(Product::class,'product_attributes');
    }

}
