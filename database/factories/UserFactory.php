<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Cliente::class, function (Faker $faker) {
    return [
        'name' => $faker->name

    ];
});
$factory->define(App\Pedido::class, function (Faker $faker) {
    return [
        'descripcion' => $faker->paragraph,
        'cliente_id' => \App\Cliente::all()->random()->id

    ];
});
