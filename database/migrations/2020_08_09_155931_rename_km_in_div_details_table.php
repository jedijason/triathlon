<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameKmInDivDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('div_details', function (Blueprint $table) {
            //
            $table->renameColumn('km', 'kms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('div_details', function (Blueprint $table) {
            //
            $table->renameColumn('kms', 'km');
        });
    }
}
