<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDivisionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('div_details', function (Blueprint $table) {
            $table->decimal('miles', 4, 2)->nullable(false);
            $table->decimal('km', 4, 2)->nullable(false);
            $table->bigInteger('div_id'  )->nullable(false)->index(false)->unsigned();
            $table->bigInteger('act_id' )->nullable(false)->index(false)->unsigned();
            $table->primary(['div_id', 'act_id']); // this is the primary key
            $table->foreign('div_id' )->references('id')->on('divisions');
            $table->foreign('act_id')->references('id')->on('activities');
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
        Schema::dropIfExists('division_details');
    }
}
