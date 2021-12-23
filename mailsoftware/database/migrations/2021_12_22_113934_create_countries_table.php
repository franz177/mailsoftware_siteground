<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->unsignedInteger('uid')->unique();
            $table->integer('pid');
            $table->smallInteger('deleted');
            $table->string('cn_iso_2', 2)->nullable();
            $table->string('cn_iso_3', 3)->nullable();
            $table->integer('cn_iso_nr');
            $table->integer('cn_parent_territory_uid');
            $table->integer('cn_parent_tr_iso_nr');
            $table->string('cn_official_name_local', 128)->nullable();
            $table->string('cn_official_name_en', 128)->nullable();
            $table->string('cn_capital', 45)->nullable();
            $table->string('cn_tldomain', 2)->nullable();
            $table->integer('cn_currency_uid');
            $table->string('cn_currency_iso_3', 3)->nullable();
            $table->integer('cn_currency_iso_nr');
            $table->integer('cn_phone');
            $table->smallInteger('cn_eu_member');
            $table->smallInteger('cn_uno_member');
            $table->smallInteger('cn_address_format');
            $table->smallInteger('cn_zone_flag');
            $table->string('cn_short_local', 70)->nullable();
            $table->string('cn_short_en', 50)->nullable();
            $table->integer('cn_country_zones');
            $table->string('cn_short_it', 50)->nullable();
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
        Schema::dropIfExists('countries');
    }
}
