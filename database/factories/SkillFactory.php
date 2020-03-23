<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Skill;
use Faker\Generator as Faker;

$factory->define(Skill::class, function (Faker $faker) {
    return [
        'name' => $faker->university,
    ];
});
