<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'content' => $faker->paragraph(10),
        'user_id' => 6,
        'link' => 'github.com/muhammadZihad',
        'avatar' => 'none'
    ];
});
