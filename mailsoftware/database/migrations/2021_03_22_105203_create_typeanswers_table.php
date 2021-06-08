<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeanswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('typeanswers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('sorting');
            $table->unsignedInteger('color_id')->nullable();
            $table->timestamps();

            $table->foreign('color_id')
                ->references('id')
                ->on('colors')
                ->onDelete('set null');
        });

        DB::table('typeanswers')->insert([
            ['name' => 'First Contact', 'sorting' => '1', 'color_id' => '1'],
            ['name' => 'Caparra ok', 'sorting' => '2', 'color_id' => '1'],
            ['name' => 'Info check-in', 'sorting' => '3', 'color_id' => '1'],
            ['name' => 'Risposta Spot', 'sorting' => '5', 'color_id' => '1'],
            ['name' => 'Post coming', 'sorting' => '4', 'color_id' => '1'],
            ['name' => 'PAGINA CLIENTE', 'sorting' => '6', 'color_id' => '1'],
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('typeanswers');
    }
}
