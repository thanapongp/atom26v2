<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('event_sets')) {
            return;
        }

        Schema::create('event_sets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('set')->unsigned();
            $table->integer('score')->unsigned();
            $table->integer('event_result_id')->unsigned();
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
        Schema::dropIfExists('event_sets');
    }
}
