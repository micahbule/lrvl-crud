<?php

use Illuminate\Database\Seeder;

class FruitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fruits')->insert([
        	'name' => 'Banana',
        	'description' => 'Yellow curved fruit.',
        	'price' => 12.50
        ]);
    }
}
