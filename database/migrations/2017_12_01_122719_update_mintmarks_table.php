<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMintmarksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('mintmarks', function(Blueprint $table){
            $table->integer('mint_id')->unsigned();
            $table->foreign('mint_id')->references('id')->on('mints');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('mintmarks', function(Blueprint $table){
            $table->dropColumn('mint_id');
        });
    }
}
