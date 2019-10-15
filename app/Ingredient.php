<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use \Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;


class Ingredient extends Model
{
    use Translatable;
    use SoftDeletes;

    protected $fillable = ['slug'];
    public $translatedAttributes = ['title'];
    public $translationModel = 'App\IngredientTranslation';

    public function meal(){
        return $this->belongsToMany('App/Meal', 'meals_ingredients', 'mealId');
    }
}
