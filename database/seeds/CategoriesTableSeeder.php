<?php

use Illuminate\Database\Seeder;

use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$categories = ['Spiaggia', 'Montagna', 'Lago', 'Camping', 'Deserto', 'Baita', 'Agriturismo', 'Tropicale', 'Isola', 'Dimore Storiche'];
        $categories = [
            [
                'name' => 'Spiaggia', 
                'image_src' => 'https://a0.muscache.com/pictures/10ce1091-c854-40f3-a2fb-defc2995bcaf.jpg', 
            ],
            [
                'name' => 'Montagna', 
                'image_src' => 'https://a0.muscache.com/pictures/757deeaa-c78f-488f-992b-d3b1ecc06fc9.jpg', 
            ],
            [
                'name' => 'Lago', 
                'image_src' => 'https://a0.muscache.com/pictures/a4634ca6-1407-4864-ab97-6e141967d782.jpg', 
            ],
            [
                'name' => 'Camping', 
                'image_src' => 'https://a0.muscache.com/pictures/ca25c7f3-0d1f-432b-9efa-b9f5dc6d8770.jpg', 
            ],
            [
                'name' => 'Deserto', 
                'image_src' => 'https://a0.muscache.com/pictures/a6dd2bae-5fd0-4b28-b123-206783b5de1d.jpg', 
            ],
            [
                'name' => 'Baita', 
                'image_src' => 'https://a0.muscache.com/pictures/732edad8-3ae0-49a8-a451-29a8010dcc0c.jpg', 
            ],
            [
                'name' => 'Agriturismo', 
                'image_src' => 'https://a0.muscache.com/pictures/aaa02c2d-9f0d-4c41-878a-68c12ec6c6bd.jpg', 
            ],
            [
                'name' => 'Tropicale', 
                'image_src' => 'https://a0.muscache.com/pictures/ee9e2a40-ffac-4db9-9080-b351efc3cfc4.jpg', 
            ],
            [
                'name' => 'Isola', 
                'image_src' => 'https://a0.muscache.com/pictures/8e507f16-4943-4be9-b707-59bd38d56309.jpg', 
            ],
            [
                'name' => 'Dimore Storiche', 
                'image_src' => 'https://a0.muscache.com/pictures/33dd714a-7b4a-4654-aaf0-f58ea887a688.jpg', 
            ],
        ];

        foreach($categories as $category) {
            $newCategory = new Category();
            $newCategory->name = $category['name'];
            $newCategory->image_src = $category['image_src'];
            $newCategory->save();
        }
    }
}