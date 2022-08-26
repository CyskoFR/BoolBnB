<?php

use Illuminate\Database\Seeder;

use App\Sponsorship;

class SponsorshipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $packages = [
            [
                'name' => 'Bronze', 
                'duration' => 24, 
                'price' => 2.99, 
            ],
            [
                'name' => 'Silver', 
                'duration' => 48, 
                'price' => 5.99, 
            ],
            [
                'name' => 'Gold', 
                'duration' => 72, 
                'price' => 9.99, 
            ],
        ];
        
        foreach($packages as $pack) {
            $sponsorship = new Sponsorship();
            $sponsorship->name = $pack['name'];
            $sponsorship->duration = $pack['duration'];
            $sponsorship->price = $pack['price'];
            $sponsorship->save();
        }
    }
}