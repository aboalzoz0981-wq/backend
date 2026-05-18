<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\User;
use App\Services\PhoneService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    protected  $phoneService;
    public function __construct(PhoneService $phoneService)
    {
        $this->phoneService = $phoneService;
    }
    public function index()
    {
      
        $products = Product::paginate(5);
        return response()->json($products, 200);
    }

    public function search($name)
    {
        $product = Product::where('name', $name)->get();
        return response()->json($product, 200);
    }
    
    public function display_my_product()
    {
        $user_id = Auth::user()->id;
        $product = Product::where('user_id',$user_id)->with('attributes')->get();
        return response()->json($product, 200);
    }

    // public function store(StoreProductRequest $request)
    // {
    //     $validated = $request->validated();
    //     $validated['user_id'] = Auth::user()->id;
    //     if ($request->hasFile('image')) {
    //         $path = $request->file('image')->store('Product_Photo', 'public');
    //         $validated['image'] = $path;
    //     }
    //     $product = Product::create($validated);
    //     return response()->json($product, 201);
    // }
    public function AddPhone(StoreProductRequest $request){
        $this->phoneService->AddProduct($request);
        return response()->json('the product added successfully', 200);
    }

    public function update_product(UpdateProductRequest $request, $product_id)
    {
        $product = Product::findOrFail($product_id);
        if (Auth::user()->id != $product->user_id)
            return response()->json(['message' => 'unuthorizeddddd'], 401);
        $validated = $request->validated();
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $path = $request->file('image')->store('Product_Photo', 'public');
            $validated['image'] = $path;
        }

        $product->update($request->validated());
        return response()->json($product, 201);
    }

    public function update_product_image(Request $request, $id)
    {
        $productOfUser = Auth::user()->products;
        $product = $productOfUser->where('id', $id)->firstOrFail();
        $request->validate([
            'image' => 'required|image|mimes:png,jpg'
        ]);
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($request->image);
            $path = $request->file('image')->store('Product_Photo', 'public');
            $product['image'] = $path;
            $product->save();
        }
        return response()->json($product, 200);
    }

    public function distroy($product_id)
    {
        $product = Product::findOrFail($product_id);
        if (Auth::user()->id != $product->user_id)
            return response()->json(['message' => 'unuthorizedd'], 401);

        $product->delete();
        return response()->json(['message' => 'Product Deleted Successfully'], 200);
    }
}
