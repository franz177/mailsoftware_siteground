<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('houses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('uid')->unique();
            $table->unsignedInteger('bank_id')->nullable();
            $table->unsignedInteger('ztl_id')->nullable();
            $table->unsignedInteger('color_id')->nullable();
            $table->integer('persone_max');
            $table->timestamps();
            $table->foreign('ztl_id')
                ->references('id')
                ->on('ztls')
                ->onDelete('set null');
            $table->foreign('bank_id')
                ->references('id')
                ->on('banks')
                ->onDelete('set null');
            $table->foreign('color_id')
                ->references('id')
                ->on('colors')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('houses');
    }
}
