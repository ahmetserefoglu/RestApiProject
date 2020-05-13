<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArizaToArizaBildirimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ariza_bildirims', function (Blueprint $table) {
            //
            $table->string('ariza_konu');
            $table->string('ariza_detay');
            $table->string('ariza_kayit_kisi');
            $table->string('ariza_durumu');
            $table->string('ariza_onay');
            $table->string('ariza_kayiteden');
            $table->integer('site_id');
            $table->integer('blok_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ariza_bildirims', function (Blueprint $table) {
            //
        });
    }
}
