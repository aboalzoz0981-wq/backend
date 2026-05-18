<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function catigory()
    {
        return $this->belongsTo(Catigory::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function attributes(){
        return $this->belongsToMany(Value_attribute::class,'product_attributes');
    }
}
