<?php

use Faker\Generator as Faker;

$factory->define(App\AliveSale::class, function (Faker $faker) {
    $quantity = $faker->randomNumber(3);
    $kg = $faker->randomFloat(2, 20, 100);
    $price = $faker->randomFloat(2, 17, 35);
    return [
        'folio' => 1,
        'date' => date('Y-m-d'),
        'quantity' => $quantity,
        'kg' => $kg,
        'price' => $faker->numberBetween(7, 9),
        'amount' => round($kg * $price, 2),
        'credit' => 0,
        'days' => 8,
        'status' => 'pagado',
        'deposit' => 0,
        'observations' => $faker->sentence,
    ];
});
