<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAracPlakasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arac_plakas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('arac_sahibi');
            $table->string('arac_plaka');
            $table->integer('site_id');
            $table->integer('plaka_id');
            $table->string('kayit_eden');
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
        Schema::dropIfExists('arac_plakas');
    }
}
