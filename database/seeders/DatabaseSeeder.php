<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coffees')->insert([   
            [ 'name' => 'Black' ],  // 1 -> 1
            [ 'name' => 'Latte' ],  // 2 -> 2 3
            [ 'name' => 'Cappuccino' ], // 3 -> 2 3 5
            [ 'name' => 'Galao' ], // 4 -> 1 4
            [ 'name' => 'Irish' ], // 5 -> 1 6 7 8
        ]);
        
        DB::table('options')->insert([   
            [ 'name' => 'Coffee' ],
            [ 'name' => 'Espresso' ],
            [ 'name' => 'Steamed milk' ],
            [ 'name' => 'Foamed milk' ],
            [ 'name' => 'Foam' ],
            [ 'name' => 'Sugar' ],
            [ 'name' => 'Cream' ],
            [ 'name' => 'Whiskey' ],
        ]);
        
        DB::table('coffee_options')->insert([   
            [ 'coffee_id' => 1, 'option_id' => 1 ],
            [ 'coffee_id' => 2, 'option_id' => 2 ],
            [ 'coffee_id' => 2, 'option_id' => 3 ],
            [ 'coffee_id' => 3, 'option_id' => 2 ],
            [ 'coffee_id' => 3, 'option_id' => 3 ],
            [ 'coffee_id' => 3, 'option_id' => 5 ],
            [ 'coffee_id' => 4, 'option_id' => 1 ],
            [ 'coffee_id' => 4, 'option_id' => 4 ],
            [ 'coffee_id' => 5, 'option_id' => 1 ],
            [ 'coffee_id' => 5, 'option_id' => 6 ],
            [ 'coffee_id' => 5, 'option_id' => 7 ],
            [ 'coffee_id' => 5, 'option_id' => 8 ],
        ]);
    }
}
