<?php

use App\AzPos\Domain\UserModel\EloquentUser;

$factory->define(EloquentUser::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'first_name' => $faker->name,
        'last_name' => $faker->lastName,
        'username' => $faker->userName,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'password' => $password ?: $password = bcrypt('1q2w3e4r'),
        'active' => 1,
        'remember_token' => str_random(10),
    ];
});
