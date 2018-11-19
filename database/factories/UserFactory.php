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

$factory->define(App\Models\User::class, function (Faker $faker) {
    static $password ;
    $password = bcrypt('123456');
    $updated_at = $faker->dateTimeThisMonth();
    $created_at = $faker->dateTimeThisMonth($updated_at);
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password,
        'activated' => 1,
        'avatar' => 'http://sanmu.test/uploads/images/avatars/201811/16/7_1542362938_caPNGK20w6.jpg',
        'introduction' => $faker->sentence(),
        'remember_token' => str_random(10),
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];
});
