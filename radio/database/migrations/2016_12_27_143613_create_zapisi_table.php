<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateZapisiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zapisi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('naziv');
            $table->string('izvodac');
            $table->string('frekvencija_kvantizacija')->default('48_24');
            $table->integer('trajanje')->default('5');
            $table->string('vrsta')->default('rock');
            $table->string('format')->default('mp3');
            $table->string('nakladnik')->default('CR');
            $table->string('vrstaNosaca')->default('cd');
            $table->integer('godina')->default('2016');
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
        Schema::dropIfExists('zapisi');
    }
}
