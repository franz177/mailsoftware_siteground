<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->timestamps();
        });

        DB::table('sections')->insert([
            ['name' => 'A00'],['name' => 'A01'],['name' => 'A02'],['name' => 'A03'],['name' => 'A04'],['name' => 'A05'],['name' => 'A06'],['name' => 'A10'],['name' => 'B01'],['name' => 'B02'],['name' => 'B03'],['name' => 'B04'],
            ['name' => 'B05'],['name' => 'B06'],['name' => 'B07'],['name' => 'C01'],['name' => 'C02'],['name' => 'C03'],['name' => 'C04'],['name' => 'C05'],['name' => 'C06'],['name' => 'C07'],['name' => 'D01'],['name' => 'D02'],
            ['name' => 'D03'],['name' => 'D04'],['name' => 'D05'],['name' => 'D06'],['name' => 'D07'],['name' => 'E01'],['name' => 'E02'],['name' => 'E03'],['name' => 'E04'],['name' => 'E05'],['name' => 'E06'],['name' => 'E07'],
            ['name' => 'F01'],['name' => 'F02'],['name' => 'F03'],['name' => 'F04'],['name' => 'F05'],['name' => 'F06'],['name' => 'F07'],['name' => 'G01'],['name' => 'G02'],['name' => 'G03'],['name' => 'G04'],['name' => 'G05'],
            ['name' => 'G06'],['name' => 'G07'],['name' => 'H01'],['name' => 'H02'],['name' => 'H03'],['name' => 'H04'],['name' => 'H05'],['name' => 'H06'],['name' => 'H07'],['name' => 'I01'],['name' => 'I02'],['name' => 'I03'],
            ['name' => 'I04'],['name' => 'I05'],['name' => 'I06'],['name' => 'I07'],['name' => 'J01'],['name' => 'J02'],['name' => 'J03'],['name' => 'J04'],['name' => 'J05'],['name' => 'J06'],['name' => 'K01'],['name' => 'K02'],
            ['name' => 'K03'],['name' => 'K04'],['name' => 'K05'],['name' => 'K06'],['name' => 'L01'],['name' => 'L02'],['name' => 'L03'],['name' => 'L04'],['name' => 'L05'],['name' => 'L06'],['name' => 'M01'],['name' => 'M02'],
            ['name' => 'M03'],['name' => 'M04'],['name' => 'M05'],['name' => 'M06'],['name' => 'N01'],['name' => 'N02'],['name' => 'N03'],['name' => 'N04'],['name' => 'N05'],['name' => 'N06'],['name' => 'O01'],['name' => 'O02'],
            ['name' => 'O03'],['name' => 'O04'],['name' => 'O05'],['name' => 'O06'],['name' => 'P01'],['name' => 'P02'],['name' => 'P03'],['name' => 'P04'],['name' => 'P05'],['name' => 'P06'],['name' => 'Q01'],['name' => 'Q02'],
            ['name' => 'Q03'],['name' => 'Q04'],['name' => 'Q05'],['name' => 'Q06'],['name' => 'R01'],['name' => 'R02'],['name' => 'R03'],['name' => 'R04'],['name' => 'R05'],['name' => 'R06'],['name' => 'S01'],['name' => 'S02'],
            ['name' => 'S03'],['name' => 'S04'],['name' => 'S05'],['name' => 'S06'],['name' => 'T01'],['name' => 'U01'],['name' => 'V01'],['name' => 'W01'],['name' => 'X01'],['name' => 'Y01'],['name' => 'Z01']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sections');
    }
}
