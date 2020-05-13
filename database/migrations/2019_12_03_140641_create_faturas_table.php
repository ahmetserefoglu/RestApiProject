<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaturasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faturas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fatura_numarasi')->unique();
            $table->string('fatura_adi');
            $table->string('fatura_ilkendeks');
            $table->string('fatura_sonendeks');
            $table->string('fatura_tutar');
            $table->string('fatura_detay');
            $table->string('fatura_tarih');
            $table->string('fatura_durum');
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
        Schema::dropIfExists('faturas');
    }
}
