<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTriathlonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('triathlons', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('triathlon_name')->nullable(false);
            $table->date('event_date_on')->nullable();
            $table->string('city', 50)->nullable(false);
            $table->string('state', 50)->nullable(false);
            $table->string('zip_code', 10)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('triathlons');
    }
}
