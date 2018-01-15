<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPIDForPhotos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('coins', function (Blueprint $table) {
            $table->string('obverse_photo_pid')->nullable();
            $table->string('reverse_photo_pid')->nullable();
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
            $table->dropColumn('obverse_photo_pid');
            $table->dropColumn('reverse_photo_pid');
        });
    }
}
