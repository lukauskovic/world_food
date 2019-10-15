<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MealTranslation extends Model
{
   protected $fillable = ['title', 'description'];
   public $timestamps = false;

}
