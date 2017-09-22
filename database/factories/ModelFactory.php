<?php
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => 'Lab3',
        'email' => 'admin',
        'level' => '1',
        'password' => Hash::make('helefante'),
        'pass' => 'helefante',
        'user' => '1',
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Client::class, function (Faker\Generator $faker) {
    $products = ['vivo', 'fresco', 'procesado', 'cerdo'];

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'address' => $faker->address,
        'rfc' => $faker->regexify('[A-Z]{3}[0-9]{2}(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1])[A-Z]{2}'),
        'phone' => $faker->phoneNumber,
        'cellphone' => $faker->phoneNumber,
        'credit' => $faker->numberBetween(0, 1),
        'notes' => $faker->randomDigit,
        'products' => serialize(array_slice($products, mt_rand(0, 4))),
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->safeColorName,
        'quantity' => 100,
        'price' => $faker->randomFloat(2, 1, 100),
        'processed' => 1,
    ];
});
