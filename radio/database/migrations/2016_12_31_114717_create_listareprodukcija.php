<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListareprodukcija extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listareprodukcija', function (Blueprint $table) {
            $table->integer('tablicarasporeda_id');
            $table->foreign('tablicarasporeda_id')->references('id')->on('tablicarasporeda')->onDelete('cascade');
            
            $table->integer('zapis_id');
            $table->foreign('zapis_id')->references('id')->on('zapisi')->onDelete('cascade');

            $table->timestamp('datum');
            $table->integer('rbr');

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
        Schema::dropIfExists('listareprodukcija');
    }
}
