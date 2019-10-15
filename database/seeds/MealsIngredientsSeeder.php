<?php

use App\Ingredient;
use App\Meal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealsIngredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ingredients = Ingredient::all('id');
        $meals = Meal::all('id');

        foreach ($meals as $meal){
            for ($i=mt_rand(0,2); $i<3;$i++){
                DB::table('meals_ingredients')->insert([
                    'mealId' => $meal->id,
                    'ingredientId' => $ingredients->random(1)[0]->id
                ]);
            }
        }
    }
}
