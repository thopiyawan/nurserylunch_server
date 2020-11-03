<?php

namespace App\Settings;

use LaravelPropertyBag\Settings\ResourceConfig;

class SchoolSettings extends ResourceConfig
{
    /**
     * Registered settings for the user. Register settings by setting name. Each
     * setting must have an associative array set as its value that contains an
     * array of 'allowed' values and a single 'default' value.
     *
     * @var array
     */
    // protected $registeredSettings = [

    //     'day_in_week' => [
    //         'allowed' => ['monday_to_friday', 'saturday', 'sunday'],
    //         'default' => 'monday_to_friday'
    //     ],

    //     'm' => [
    //         'allowed' => [1, 2, 3, 4],
    //         'default' => 
    //     ]

    // ];

    public function registeredSettings()
    {
        return collect([
            'is_weekday' => [
                'allowed' => [true, false],
                'default' => true
            ],
            'is_satuday' =>[
                'allowed' => [true, false],
                'default' => false
            ]
        ]);
    } 
}
