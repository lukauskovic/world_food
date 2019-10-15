<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ingredient_translations', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('ingredient_id')->unsigned();
            $table->string('title');
            $table->string('locale')->index();
            $table->unique(['ingredient_id','locale']);
            $table->foreign('ingredient_id')->references('id')->on('ingredients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredients');
    }
}
