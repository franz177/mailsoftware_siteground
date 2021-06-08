<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('nome_banca');
            $table->string('beneficiario');
            $table->string('indirizzo')->nullable();
            $table->string('bic')->nullable();
            $table->string('swift')->nullable();
            $table->string('iban', 27);
            $table->string('causale');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('banks')->insert([
            ['name' => 'No Banca', 'nome_banca' => '0', 'beneficiario' => '0', 'indirizzo' => '0', 'bic' => '0', 'swift' => '0', 'iban' => '0', 'causale' => '0'],
            ['name' => 'LALLA', 'nome_banca' => 'FINECO BANK (Unicredit)', 'beneficiario' => 'Laura Amelia Dessy', 'indirizzo' => 'salita san Nicola da Tolentino,1/b 00187 Roma', 'bic' => 'UNCRITMM', 'swift' => 'FEBIITM1', 'iban' => 'IT22I0301503200000002917531', 'causale' => 'ALGHERO'],
            ['name' => 'SIMONETTA', 'nome_banca' => 'FINECO BANK (Unicredit)', 'beneficiario' => 'Simonetta Ruju', 'indirizzo' => 'salita san Nicola da Tolentino,1/b 00187 Roma', 'bic' => 'UNCRITMM', 'swift' => 'FEBIITM1', 'iban' => 'IT54B0301503200000002741366', 'causale' => 'ALGHERO'],
            ['name' => 'SANDRO', 'nome_banca' => 'INTESA SAN PAOLO', 'beneficiario' => 'Alessandro e Caterina Ruju', 'indirizzo' => 'Piazza d\'Italia 07100 Sassari', 'bic' => '', 'swift' => 'BCITITMM', 'iban' => 'IT71X03069172370832851201', 'causale' => 'NULVI'],
            ['name' => 'BELLA', 'nome_banca' => 'Mediolanum', 'beneficiario' => 'Maria Luisa Bella', 'indirizzo' => '', 'bic' => '', 'swift' => '', 'iban' => 'IT09A0306234210000001679765', 'causale' => 'ALGHERO']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banks');
    }
}
