<?php

use App\Meal;
use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsMealsSeeder extends Seeder
{

    public function run()
    {
        $tags = Tag::all('id');
        $meals = Meal::all('id');

        foreach ($meals as $meal){
            for ($i=mt_rand(0,2); $i<3;$i++){
                DB::table('meals_tags')->insert([
                    'mealId' => $meal->id,
                    'tagId' => $tags->random(1)[0]->id
                ]);
            }
        }
    }
}
