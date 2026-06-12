<?php

namespace Database\Seeders;

use App\Models\Technical_Specifications;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttributesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes= [ 
            "RAM"
            ,"CPU"
            ,"Space"
            ,"Screen_size"
            ,"GPU"
            ,"Camera"
            ,"Storage"
            ,"Color"
            ];

          foreach($attributes as $attribute){
            Technical_Specifications::create([
                'name'=>$attribute
            ]);
          }
    }
}
