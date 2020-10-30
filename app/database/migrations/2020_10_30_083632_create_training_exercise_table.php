<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingExerciseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_exercise', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger("exercise_id")->unsigned();
            $table->bigInteger("training_id")->unsigned();
            $table->foreign("exercise_id")->references("id")->on("exercises");
            $table->foreign("training_id")->references("id")->on("trainings");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_exercise');
    }
}
