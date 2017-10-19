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
            'name' => 'pollo fresco',
            'processed' => 0,
        ]);
        factory(App\Product::class)->create([
            'name' => 'pollo vivo',
            'processed' => 0,
        ]);
        factory(App\Product::class)->create([
            'name' => 'procesado',
            'processed' => 0,
        ]);

    }
}
