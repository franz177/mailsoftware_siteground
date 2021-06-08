<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('city');
            $table->string('cap', 5);
            $table->string('provincia');
            $table->timestamps();
        });
        // Insert some stuff
        DB::table('cities')->insert([
            ['city' => 'Alghero', 'cap' => '07041', 'provincia' => 'Sassari (SS)'],
            ['city' => 'Nulvi', 'cap' => '07032', 'provincia' => 'Sassari (SS)']

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
