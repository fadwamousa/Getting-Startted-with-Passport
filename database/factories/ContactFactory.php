<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Contact::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'phone'=>$faker->phoneNumber,
        'user_id'=> function(){
          return User::all()->random()->id;
        }
    ];
});
