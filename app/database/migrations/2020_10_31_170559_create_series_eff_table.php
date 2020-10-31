<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeriesEffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('series_effs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('exercise_eff_id')->constrained();
            $table->integer("rep");
            $table->float("weight",5,2);
            $table->integer("pause");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('series_effs');
    }
}
