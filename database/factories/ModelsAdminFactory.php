<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Admin::class, function (Faker $faker) {
    return [
        'admin_full_name' => env('ADMIN_FULL_NAME','ATMIYA EVENT MANAGEMENT SYSTEM'),
        'admin_username' => env('ADMIN_USERNAME','aems@edu.in'),
        'admin_password' => bcrypt(env('ADMIN_PASSWORD','secret')),
        'admin_mobile' => env('ADMIN_MOBILE','9737124194')
    ];
});
