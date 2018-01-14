<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCoinssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('coins', function(Blueprint $table){
            $table->integer('mint_id')->unsigned();
            $table->integer('mintmark_id')->unsigned();
            $table->foreign('mint_id')->references('id')->on('mints');
            $table->foreign('mintmark_id')->references('id')->on('mintmarks');
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
        Schema::table('coins', function(Blueprint $table){
            $table->dropColumn('mint_id', 'mintmark_id');
        });
    }
}
