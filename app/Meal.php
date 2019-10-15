<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Dimsav\Translatable\Translatable;

class Meal extends Model
{
    use SoftDeletes;
    use Translatable;

    protected $fillable = ['slug'];
    public $translatedAttributes = ['title', 'description'];
    public $translationModel = 'App\MealTranslation';

    public function category(){
        return $this->hasOne('App/Category' , 'categoryId');
    }

    public function tag(){
        return $this->belongsToMany('App/Tag', 'meals_tags', 'mealId');
    }

    public function ingredient(){
        return $this->belongsToMany('App/Ingredient', 'meals_ingredients', 'mealId');
    }

}

