<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhotoFieldsCoinsTable extends Migration
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
            $table->string('obverse_photo')->nullable();
            $table->string('reverse_photo')->nullable();
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
            $table->dropColumn('obverse_photo');
            $table->dropColumn('reverse_photo');
        });
    }
}
