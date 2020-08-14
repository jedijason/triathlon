<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\False_;

class CreateTriathlonDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tri_details', function (Blueprint $table) {
            $table->timestamps();
            $table->bigInteger('usr_id'      )->nullable(false)->index(false)->unsigned();
            $table->bigInteger('tri_id' )->nullable(false)->index(false)->unsigned();
            $table->bigInteger('div_id'  )->nullable(false)->index(false)->unsigned();
            $table->bigInteger('act_id' )->nullable(false)->index(false)->unsigned();
            $table->primary(['usr_id', 'tri_id', 'div_id', 'act_id']);// this is the primary key
            $table->foreign('usr_id')->references('id')->on('users');
            $table->foreign('tri_id')->references('id')->on('triathlons');
            $table->foreign('div_id')->references('id')->on('divisions');
            $table->foreign('act_id')->references('id')->on('activities');
            $table->decimal('minutes', 6, 2)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('triathlon_details');
    }
}
