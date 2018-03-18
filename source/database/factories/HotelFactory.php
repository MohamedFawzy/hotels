<?php


use Faker\Generator as Faker;

$factory->define(App\Hotel::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->randomFloat(2,50,200),
        'city'  => $faker->city,
        'availability' => [
            [
                'from' => $faker->date('d-m-Y'),
                'to'   => $faker->date('d-m-Y')
            ],
            [
                'from' => $faker->date('d-m-Y'),
                'to'   => $faker->date('d-m-Y')
            ]
        ]
    ];
});