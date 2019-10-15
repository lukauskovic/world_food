<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategoriesTableSeeder::class);
        $this->call(IngredientsTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(MealsTableSeeder::class);
        $this->call(TagsMealsSeeder::class);
        $this->call(MealsIngredientsSeeder::class);
    }
}
