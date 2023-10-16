<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trains', function (Blueprint $table) {
            $table->id();
            $table->string('company_name', 50);
            $table->string('departure_station', 30);
            $table->string('arrival_station', 30);
            $table->dateTime('departure_time');
            $table->dateTime('arrival_time');
            $table->integer('train_code');
            $table->tinyInteger('number_of_carriages');
            $table->boolean('in_time');
            $table->boolean('deleted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trains');
    }
};