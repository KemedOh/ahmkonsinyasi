<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    private $product_types = [
        ["makanan", "Makanan"],
        ["minuman", "Minuman"],
        ["electronik", "Electronik"],
        ["furnitur", "Furnitur"],
        ["perabotan", "Perabotan"],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->product_types as $product_type) {
            \App\Models\product_type::create([
                #  "id" => $product_type[0],
                "product_type_name" => $product_type[1],
            ]);
        }
    }
}
