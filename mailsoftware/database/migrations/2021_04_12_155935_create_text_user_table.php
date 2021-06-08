<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('text_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_uid');
            $table->integer('text_id')->unsigned();
            $table->foreign('text_id')
                ->references('id')
                ->on('texts')
                ->onDelete('cascade');
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
        Schema::dropIfExists('text_user');
    }
}
