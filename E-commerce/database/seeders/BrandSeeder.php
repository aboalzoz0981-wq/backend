<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                1,
                'Samsung'
            ],
            [
                2 , 
                'Lenovo'
            ],
            [
                3,
                'Anker'
            ],
            [
                4,
                'Logitech G'
            ]            
        ];
       
        foreach($brands as $brand){
            Brand::create([
                'catigory_id'=>$brand[0],
                'name'=>$brand[1]
                ]);
        }
    }
}
