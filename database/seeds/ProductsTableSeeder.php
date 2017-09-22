<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Product::class)->create([
            'name' => 'cerdo',
            'processed' => 0,
        ]);
        factory(App\Product::class)->create([
            'name' => 'pollo vivo',
            'processed' => 0,
        ]);
        factory(App\Product::class)->create([
            'name' => 'alimento cerdo',
            'processed' => 0,
        ]);
        factory(App\Product::class)->create([
            'name' => 'alimento pollo',
            'processed' => 0,
        ]);
        
        factory(App\Product::class, 14)->create();
    }
}
