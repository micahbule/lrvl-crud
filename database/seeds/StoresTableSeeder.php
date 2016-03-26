<?php

use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stores')->insert([
        	'name' => '7-11 Cubao Farmers',
        	'address' => 'Farmer\'s Market, Cubao',
        	'contact' => 'farmers.cubao@711.com'
        ]);
    }
}
