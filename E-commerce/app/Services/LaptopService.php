<?php

namespace App\Services;

use App\Http\Requests\StoreProductRequest;
use App\Models\Product;
use App\Models\Technical_Specifications;
use App\Models\Value_attribute;
use Auth;

class LaptopService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function AddProduct(StoreProductRequest $request)
    {

        $validated = $request->validated();
        $validated['user_id'] = Auth::user()->id;
        $product = Product::create($validated);
        $validates = $request->validate([
            'GPU' => 'required|string',
            'CPU' => 'required|string',
            'RAM' => 'required|string',
            'Storage' => 'required|string',
            'Color' => 'required|string'
        ]);
        foreach ($validates as $key => $value) {
            $validate_id = Technical_Specifications::where('name', $key)->value('id');
            if ($validate_id) {
                $insertedvalue = Value_attribute::create([
                    'technical_specifications_id' => $validate_id,
                    'value' => $value
                ]);
                $product->attributes()->attach($insertedvalue->id);
            }
        }
    }
}
