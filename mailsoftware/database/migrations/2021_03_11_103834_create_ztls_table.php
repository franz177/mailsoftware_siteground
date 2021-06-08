<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZtlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ztls', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('city_id')->nullable();
            $table->string('description');
            $table->string('ztl_da_am', 5)->nullable();
            $table->string('ztl_a_am', 5)->nullable();
            $table->string('ztl_out_am', 5)->nullable();
            $table->string('ztl_da_pm', 5)->nullable();
            $table->string('ztl_a_pm', 5)->nullable();
            $table->string('ztl_out_pm', 5)->nullable();
            $table->timestamps();
            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('set null');
        });

        DB::table('ztls')->insert([
            ['city_id' => NULL, 'description' => 'No ZTL', 'ztl_da_am' => NULL, 'ztl_a_am' => NULL, 'ztl_out_am' => NULL, 'ztl_da_pm' => NULL, 'ztl_a_pm' => NULL, 'ztl_out_pm' => NULL],
            ['city_id' => 1, 'description' => 'Centro Storico', 'ztl_da_am' => '8:00', 'ztl_a_am' => '10:30', 'ztl_out_am' => '11:00', 'ztl_da_pm' => '14:30', 'ztl_a_pm' => '16:30', 'ztl_out_pm' => '17:00']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ztls');
    }
}
