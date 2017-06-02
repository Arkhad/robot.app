<?php

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
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Robot::class, function (Faker\Generator $faker) {

    $names = [
            'Alan',
            'Albert',
            'RDX',
            'Anthony-R',
            'Ben-RD',
            'RD2',
            'J-RD',
            'Jarvis',
            'Arkhad',
    ];

    $types = [
            'DDR1',
            'DDR2',
            'DDR3',
            'DDR4'
    ];

    $tab = ["published", "unpublished"];
    $rand = array_rand($tab, 1);
    $random = array_rand($types, 1);

    $alea = (mt_rand() / mt_getrandmax());

    $title = $names[array_rand($names)];

    return [
            'name'         => $title,
            'category_id'  => ($alea < 0.66) ? rand(1, 3) : NULL,
            'user_id'      => rand(1, 3),
            'slug'         => str_slug($title),
            'description'  => $faker->paragraph(rand(5, 20)),
            'published_at' => $faker->dateTime(),
            'status'       => $tab[$rand],
            'power'        => rand(0, 100),
            'type'         => $types[$random],
    ];
});