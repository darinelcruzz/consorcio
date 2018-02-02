<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Client::class, 20)
            ->create()
            ->each(function ($client) {
                $client->alivesales()->save(factory(App\AliveSale::class)->create());
                $client->freshsales()->save(factory(App\FreshSale::class)->create());
                $client->porksales()->save(factory(App\PorkSale::class)->create());
            });
    }
}
