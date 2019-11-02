<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Concert;
use Faker\Generator as Faker;
use Illuminate\Support\Carbon;

$factory->define(App\Concert::class, function (Faker $faker) {
    return [
        'title' => 'Example Band',
        'subtitle' => 'with Fake Openers',
        'date' => Carbon::parse("+2 weeks"),
        'ticket_price' => 2000,
        'venue' => "The Example",
        'venue_address' => '123 Example Lane',
        'city' => 'Laraville',
        'state' => 'ON',
        'zip' => '129123',
        'additional_information' => 'Sample information'
    ];
});
