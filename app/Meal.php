<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Dimsav\Translatable\Translatable;

class Meal extends Model
{
    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = ['title', 'description'];
    public $translationModel = 'App\MealTranslation';

    public function category(){
        return $this->belongsTo('App\Category', 'categoryId');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag', 'meals_tags', 'mealId', 'tagId');
    }

    public function ingredients(){
        return $this->belongsToMany('App\Ingredient', 'meals_ingredients', 'mealId', 'ingredientId');
    }

}

