<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use App\User;
use App\Category;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    $users = User::pluck('id')->toArray();
    $categories = Category::pluck('id')->toArray();
    return [
        'category_id' => $faker->randomElement($categories),
        'owner_id' => $faker->randomElement($users),
        'title' => $faker->word(),
        'description' => $faker->sentence(490),
        'writer' => $faker->lastName,
        'viewer' => $faker->numberBetween(0, 10)
    ];
});
