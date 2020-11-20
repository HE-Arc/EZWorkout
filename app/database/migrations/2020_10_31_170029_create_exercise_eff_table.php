<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExerciseEffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exercise_effs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            #$table->foreignId('exercise_id')->constrained();
            $table->foreignId('training_eff_id')->constrained();
            $table->boolean("skipped");
            $table->integer('pause');
            $table->integer('rating')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exercise_effs');
    }
}
