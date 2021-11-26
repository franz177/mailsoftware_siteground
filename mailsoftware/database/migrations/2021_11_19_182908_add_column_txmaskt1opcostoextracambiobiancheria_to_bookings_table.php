<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTxmaskt1opcostoextracambiobiancheriaToBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->integer('tx_mask_t1_op_costo_extra_cambio_biancheria')->default(0)->after('tx_mask_t1_op_tipo_checkin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('tx_mask_t1_op_costo_extra_cambio_biancheria');
        });
    }
}
