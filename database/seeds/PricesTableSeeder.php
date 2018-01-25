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
            'name' => 'Demás y Foráneo',
            'product_id' => 3,
            'price' => 22,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Súper Especial',
            'product_id' => 4,
            'price' => 31,
            'processed' => 1,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Comitán, Marg. y Tzimol',
            'product_id' => 4,
            'price' => 32,
            'processed' => 1,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Foráneo',
            'product_id' => 4,
            'price' => 33,
            'processed' => 1,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Pechuga sin hueso',
            'product_id' => 10,
            'price' => 90,
            'processed' => 1,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Pechuga con hueso',
            'product_id' => 11,
            'price' => 72,
            'processed' => 1,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Pierna y muslo',
            'product_id' => 12,
            'price' => 38,
            'processed' => 1,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Alas picosas',
            'product_id' => 13,
            'price' => 68,
            'processed' => 1,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Ala (1 y 2)',
            'product_id' => 14,
            'price' => 65,
            'processed' => 1,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Molleja',
            'product_id' => 15,
            'price' => 30,
            'processed' => 1,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Víscera mixta',
            'product_id' => 16,
            'price' => 20,
            'processed' => 1,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Pollo Adobado',
            'product_id' => 17,
            'price' => 44,
            'processed' => 1,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Tzimol',
            'product_id' => 2,
            'price' => 39,
            'processed' => 0,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Carmen-xhan',
            'product_id' => 2,
            'price' => 40,
            'processed' => 0,
        ]);
        factory(App\Price::class)->create([
            'name' => 'Cortes',
            'product_id' => 4,
            'price' => 0,
            'processed' => 1,
        ]);
    }
}
