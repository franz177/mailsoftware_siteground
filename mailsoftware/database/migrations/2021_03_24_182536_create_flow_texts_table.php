<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlowTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flow_text', function (Blueprint $table) {
            $table->id();
            $table->integer('flow_id')->unsigned();
            $table->integer('text_id')->unsigned();
            $table->integer('block_id')->unsigned();
            $table->integer('section_id')->unsigned();
            $table->timestamps();
            $table->foreign('flow_id')
                ->references('id')
                ->on('flows')
                ->onDelete('cascade');
            $table->foreign('text_id')
                ->references('id')
                ->on('texts')
                ->onDelete('cascade');
            $table->foreign('block_id')
                ->references('id')
                ->on('blocks')
                ->onDelete('cascade');
            $table->foreign('section_id')
                ->references('id')
                ->on('sections')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flow_text');
    }
}
