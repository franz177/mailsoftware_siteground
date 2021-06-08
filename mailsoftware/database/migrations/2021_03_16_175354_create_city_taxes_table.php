<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCityTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('city_taxes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('city_id')->nullable();
            $table->string('description');
            $table->integer('mese_da')->nullable();
            $table->integer('mese_a')->nullable();
            $table->integer('debit')->nullable();
            $table->integer('notti_max')->nullable();
            $table->integer('anni_max_adulti')->nullable();
            $table->integer('anni_max_bambini')->nullable();
            $table->timestamps();
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('set null');

        });

        // Insert some stuff
        DB::table('city_taxes')->insert([
            ['city_id' => NULL, 'description' => 'NO CITYTAX', 'mese_da' => NULL, 'mese_a' => NULL, 'debit' => NULL, 'notti_max' => NULL, 'anni_max_adulti' => NULL, 'anni_max_bambini' => NULL],
            ['city_id' => 1, 'description' => 'Alta Stagione', 'mese_da' => 5, 'mese_a' => 9, 'debit' => 50, 'notti_max' => 7, 'anni_max_adulti' => 12, 'anni_max_bambini' => 0],
            ['city_id' => 1, 'description' => 'Bassa Stagione', 'mese_da' => 10, 'mese_a' => 4, 'debit' => 25, 'notti_max' => 7, 'anni_max_adulti' => 12, 'anni_max_bambini' => 0]

        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('city_taxes');
    }
}
