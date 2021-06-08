<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('descrizione');
            $table->longText('description');
            $table->timestamps();
        });

        DB::table('rooms')->insert([
            ['name' => 'LA Fish House - Soggiorno', 'descrizione' => 'un soggiorno due comodi divani letto singoli', 'description' => 'a livingroom two comfortable sofa beds'],
            ['name' => 'LA Fish House - Alcova', 'descrizione' => 'un\'alcova un letto matrimoniale (160cm x 190cm)  che può essere diviso in due letti singoli a richiesta', 'description' => 'an alcova a queen bed (160cm x 190cm)  that we can split in two twin beds if required'],
            ['name' => 'CA Casa Blu - Camera da Letto', 'descrizione' => 'una camera da letto un letto matrimoniale (180cm x 190cm) che puÃ² essere diviso in due singoli a richiesta', 'description' => 'a bedroom a big double bed (180cm x 190cm) that we can split in two twin beds if required'],
            ['name' => 'CA Casa Blu - Soggiorno', 'descrizione' => 'un soggiorno due comodi divani letto singoli', 'description' => 'a livingroom two comfortable sofa beds'],
            ['name' => 'PE Casa Turchese - Alcova', 'descrizione' => 'un\'alcova un letto matrimoniale (160cm x 190cm)', 'description' => 'an alcova a queen bed (160cm x 190cm)'],
            ['name' => 'PE Casa Turchese - Soggiorno', 'descrizione' => 'un soggiorno un comodo divano letto matrimoniale', 'description' => 'a livingroom a comfortable double sofa bed'],
            ['name' => 'Corte d\'Anglona - Grande Camera da Letto', 'descrizione' => 'una grande camera da letto un letto matrimoniale (180cm x 190cm)', 'description' => 'a big bedroom a big double bed (180cm x 190cm)'],
            ['name' => 'Corte d\'Anglona - Camera da Letto', 'descrizione' => 'una camera da letto due letti singoli', 'description' => 'a bedroom two twin beds'],
            ['name' => 'Corte d\'Anglona - Salottino', 'descrizione' => 'un salottino un comodo divano letto singolo', 'description' => 'a little livingroom a single comfortable sofa bed'],
            ['name' => 'Corte d\'Anglona - Letto Pieghevole', 'descrizione' => 'a richiesta un letto pieghevole', 'description' => 'on demand an extra bed'],
            ['name' => 'VER Casa Verde - Open Space', 'descrizione' => 'un open space un letto matrimoniale (170cm x 190cm)  divisibile in due letti singoli a richiesta  e un pouf/letto singolo', 'description' => 'an open space a big double bed (170cm x 190cm)  that we can split in two twin beds if required  and a pouf/single bed'],
            ['name' => 'STE CasettaBella31 - Cucina Spaziosa', 'descrizione' => 'una cucina spaziosa con sistema ad induzione  frigo  freezer e lavatrice', 'description' => 'a comfortable kitchen with induction cooker system  fridge  freezer and washing machine'],
            ['name' => 'STE CasettaBella31 - Camera da Letto', 'descrizione' => 'una camera da letto un letto alla francese (140cm x 200cm)', 'description' => 'a bedroom a Queen bed (140cm x 200cm)']
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
