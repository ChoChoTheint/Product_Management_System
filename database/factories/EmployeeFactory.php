<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */



use App\Model\Employee;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Employee::class, function (Faker $faker) {
    
    static $num = 10000;
    $newPassword = 'Admin123!@#';
    return [
        
        'emp_id' => $num++,
        'emp_name' => $faker->name(),
        'password' => Hash::make($newPassword),

    ];
    
});
