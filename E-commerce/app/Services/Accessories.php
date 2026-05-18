<?php

namespace App\Services;

class Accessories
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function create()
    {
        return response()->json("Aboood", 200);
    }
}
