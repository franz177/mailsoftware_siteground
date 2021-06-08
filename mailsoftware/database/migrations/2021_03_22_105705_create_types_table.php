<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('sorting');
            $table->timestamps();
        });

        DB::table('types')->insert([
            ['name' => 'Assisted', 'sorting' => '7'], ['name' => 'Pren. Immediata', 'sorting' => '1'],
            ['name' => 'Last Minute assiste', 'sorting' => '8'], ['name' => 'Caparra', 'sorting' => '4'],
            ['name' => 'Accetta/Rifiuta', 'sorting' => '2'], ['name' => 'Testo Libero', 'sorting' => '10'],
            ['name' => 'Pre-approvazione', 'sorting' => '3'], ['name' => 'Self', 'sorting' => '6'],
            ['name' => 'No Caparra', 'sorting' => '5'], ['name' => 'Keep in touch', 'sorting' => '9'],
            ['name' => 'Keep in touch no questionario', 'sorting' => '11'], ['name' => 'Not available', 'sorting' => '12'],
            ['name' => 'WAPP 1', 'sorting' => '14'], ['name' => 'WAPP 2', 'sorting' => '15'],
            ['name' => 'Last minute self', 'sorting' => '18'], ['name' => 'Option', 'sorting' => '19'],
            ['name' => 'WAPP 0', 'sorting' => '0'], ['name' => 'WAPP 3', 'sorting' => '20'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
}
