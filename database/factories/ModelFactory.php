<?php

/*
 * |--------------------------------------------------------------------------
 * | Model Factories
 * |--------------------------------------------------------------------------
 * |
 * | Here you may define all of your model factories. Model factories give
 * | you a convenient way to create models for testing and seeding your
 * | database. Just tell the factory how a default model should look.
 * |
 */
$factory->define(Gas\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'situation' => 'inativo',
        'role' => 'user',
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10)
    ];
});

$factory->define(Gas\Models\Product::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'unidade' => $faker->randomLetter . $faker->randomLetter,
        'sale_price' => $faker->randomFloat(2, 500, 1000),
        'cost_price' => $faker->randomFloat(2, 10, 400),
        'active' => true
    ];
});

$factory->define(Gas\Models\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'company_name' => $faker->company,
        'document' => random_int(10000, 999999),
        'phone' => $faker->phoneNumber,
        'email' => $faker->companyEmail,
        'address' => $faker->streetName,
        'complement' => $faker->sentence,
        'address_number' => random_int(0, 2000),
        'city' => $faker->city,
        'state' => $faker->countryCode,
        'zip_code' => random_int(10000, 99999),
        'branch_id' => random_int(1, 5),
        'active' => $faker->boolean
    ];
});

$factory->define(Gas\Models\Branch::class, function (Faker\Generator $faker) {
    return [
        'company_name' => $faker->company,
        'document' => random_int(10000, 999999),
        'phone' => $faker->phoneNumber,
        'email' => $faker->companyEmail,
        'address' => $faker->streetName,
        'complement' => $faker->sentence,
        'address_number' => random_int(0, 2000),
        'city' => $faker->city,
        'state' => $faker->countryCode,
        'zip_code' => random_int(10000, 99999),
        'active' => $faker->boolean
    ];
});

$factory->define(Gas\Models\Seller::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'document' => random_int(10000, 999999),
        'phone' => $faker->phoneNumber,
        'email' => $faker->companyEmail,
        'address' => $faker->streetName,
        'complement' => $faker->sentence,
        'address_number' => random_int(0, 2000),
        'city' => $faker->city,
        'state' => $faker->countryCode,
        'zip_code' => random_int(10000, 99999),
        'branch_id' => random_int(1, 5),
        'active' => $faker->boolean
    ];
});

$factory->define(Gas\Models\Sale::class, function (Faker\Generator $faker) {
    return [
        'client_id' => random_int(1, 50),
        'seller_id' => random_int(1, 10),
        'branch_id' => random_int(1, 5),
        'sale_date' => $faker->date(),
        'payment_date' => $faker->date(),
        'amount' => $faker->randomFloat(),
        'discount_value' => 0,
        'value_addition' => 0,
        'payment_form' => $faker->word,
        'plots' => random_int(1, 5),
        'situation' => random_int(1, 3)
    ];
});

$factory->define(Gas\Models\SaleItem::class, function (Faker\Generator $faker) {
    return [
        'product_id' => random_int(1, 10),
        'sale_id' => random_int(1, 10),
        
        'price' => $faker->randomFloat(),
        'quantity' => $faker->randomFloat(2, 1, 3)

    ];
});
    