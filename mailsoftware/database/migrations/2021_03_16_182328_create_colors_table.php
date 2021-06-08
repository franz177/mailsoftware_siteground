<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateColorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('colore_bg')->nullable();
            $table->string('colore_font')->nullable();
            $table->timestamps();
        });

        DB::table('colors')->insert([
            ['name' => 'BLACK', 'colore_bg' => 'black', 'colore_font' => ''],
            ['name' => 'BLUE STEEL', 'colore_bg' => 'blue-steel', 'colore_font' => ''],
            ['name' => 'GREEN SEAGREEN', 'colore_bg' => 'green-seagreen', 'colore_font' => ''],
            ['name' => 'GREEN', 'colore_bg' => 'green', 'colore_font' => ''],
            ['name' => 'PURPLE MEDIUM', 'colore_bg' => 'purple-medium', 'colore_font' => ''],
            ['name' => 'WARNING', 'colore_bg' => 'warning', 'colore_font' => ''],
            ['name' => 'PURPLE SOFT', 'colore_bg' => 'purple-soft', 'colore_font' => ''],
            ['name' => 'YELLOW CASABLANCA', 'colore_bg' => 'yellow-casablanca', 'colore_font' => ''],
            ['name' => 'RED', 'colore_bg' => 'red', 'colore_font' => '']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('colors');
    }
}
