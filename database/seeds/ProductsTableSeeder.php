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
            'name' => 'Cerdo',
            'processed' => 0,
        ]);
        factory(App\Product::class)->create([
            'name' => 'Pollo fresco',
            'processed' => 0,
        ]);
        factory(App\Product::class)->create([
            'name' => 'Pollo vivo',
            'processed' => 0,
        ]);
        factory(App\Product::class)->create([
            'name' => 'Grande',
            'processed' => 1,
        ]);
        factory(App\Product::class)->create([
            'name' => 'Mediano',
            'processed' => 1,
        ]);
        factory(App\Product::class)->create([
            'name' => 'Chico',
            'processed' => 1,
        ]);
        factory(App\Product::class)->create([
            'name' => 'Junior',
            'processed' => 1,
        ]);
        factory(App\Product::class)->create([
            'name' => 'Petit',
            'processed' => 1,
        ]);
        factory(App\Product::class)->create([
            'name' => 'Pechuga sin hueso',
            'processed' => 1,
        ]);
        factory(App\Product::class)->create([
            'name' => 'Pechuga con hueso',
            'processed' => 1,
        ]);
        factory(App\Product::class)->create([
            'name' => 'Pierna y muslo',
            'processed' => 1,
        ]);
        factory(App\Product::class)->create([
            'name' => 'Alas picosas',
            'processed' => 1,
        ]);
        factory(App\Product::class)->create([
            'name' => 'Ala (1 y 2)',
            'processed' => 1,
        ]);
        factory(App\Product::class)->create([
            'name' => 'Molleja',
            'processed' => 1,
        ]);
        factory(App\Product::class)->create([
            'name' => 'Víscera mixta',
            'processed' => 1,
        ]);
        factory(App\Product::class)->create([
            'name' => 'Pollo Adobado',
            'processed' => 1,
        ]);
        factory(App\Product::class)->create([
            'name' => 'Alimento cerdo',
            'processed' => 2,
        ]);
        factory(App\Product::class)->create([
            'name' => 'Alimento pollo',
            'processed' => 2,
        ]);
        factory(App\Product::class)->create([
            'name' => 'Procesado',
            'processed' => 2,
        ]);
    }
}
