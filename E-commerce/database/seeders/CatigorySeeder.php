<?php

namespace Database\Seeders;

use App\Models\Catigory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatigorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catigories = [
            'Phones',
            'Laptops',
            'Accessories',
            'Gaming',
        ];
        foreach($catigories as $catigory){
            Catigory::create(['name'=>$catigory]);
        }
    }
}
