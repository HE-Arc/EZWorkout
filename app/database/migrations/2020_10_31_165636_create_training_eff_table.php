<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingEffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_effs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('logbookPage_id')->constrained();
            $table->foreignId('training_id')->constrained();
            $table->date("date");
            $table->boolean("skipped");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_effs');
    }
}
