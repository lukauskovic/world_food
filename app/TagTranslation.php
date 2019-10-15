<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TagTranslation extends Model
{
    protected $fillable = ['title'];
    public $timestamps = false;
}
