<?php

namespace App\Http\Controllers;

use App\Models\Catigory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CatigoryController extends Controller
{
  ///////////////////////////////////// توابع للأدمن
    public function store(Request $request){
        $request->validate(['name'=>'required|string']);
        $catigory = Catigory::create($request->validated());
       
        return response()->json($catigory, 201);
    }

    public function distroy($catigory_id){
        Catigory::findOrFail($catigory_id)->delete();
        return response()->json(['message'=>'Catigory Deleted Successfully'], 204);
    }
}
