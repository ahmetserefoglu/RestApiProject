<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDegerlendirmesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('degerlendirmes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('degerlendirme_konu');
            $table->string('degerlendirme_derece');
            $table->string('degerlendiren_kullanici');
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
        Schema::dropIfExists('degerlendirmes');
    }
}
