<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameStAndCityInTriathlonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('triathlons', function (Blueprint $table) {
            //
            $table->renameColumn('state', 'state_name');
            $table->renameColumn('city', 'city_name');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('triathlons', function (Blueprint $table) {
            //
            $table->renameColumn('state_name', 'state');
            $table->renameColumn('city_name', 'city');

        });
    }
}
