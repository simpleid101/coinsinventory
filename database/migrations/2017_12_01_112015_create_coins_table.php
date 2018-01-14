<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('field_inventory');
            $table->integer('bag_number');
            $table->string('emperor')->nullable();
            $table->string('obverse')->nullable();
            $table->string('reverse')->nullable();
            //$table->foreign('mint_id')->references('id')->on('mints')->nullable();
            //$table->foreign('mintmark_id')->references('id')->on('mintmarks')->nullable();
            $table->string('emission')->nullable();
            $table->float('weight', 5,2);
            $table->integer('diameter');
            $table->string('denomination')->nullable();
            $table->integer('axis')->nullable();
            $table->string('reference')->nullable();
            $table->string('location');
            $table->date('find_date');
            $table->string('square')->nullable();
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
        Schema::dropIfExists('coins');
    }
}
