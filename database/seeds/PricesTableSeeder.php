<?php

use Illuminate\Database\Seeder;

class PricesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Price::class)->create([
            'name' => 'Primera',
            'product_id' => 1,
            'price' => 32,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Segunda',
            'product_id' => 1,
            'price' => 31,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Flete directo',
            'product_id' => 1,
            'price' => 2,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Primera',
            'product_id' => 2,
            'price' => 30,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Segunda',
            'product_id' => 2,
            'price' => 29,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Publico en general',
            'product_id' => 2,
            'price' => 34,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Super especial',
            'product_id' => 3,
            'price' => 20,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Especial',
            'product_id' => 3,
            'price' => 21,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Foraneo',
            'product_id' => 3,
            'price' => 22,
        ]);

    }
}
