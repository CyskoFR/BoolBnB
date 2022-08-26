<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //seeder globale database
         $this->call(
            [SponsorshipsTableSeeder::class,
            CategoriesTableSeeder::class, 
            ServicesTableSeeder::class]);
    }
}
