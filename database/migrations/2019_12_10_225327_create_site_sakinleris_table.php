<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSiteSakinlerisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_sakinleris', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('site_id');
            $table->integer('site_blok_id');
            $table->string('site_sakini_adi');
            $table->string('daire_bilgileri');
            $table->boolean('evsahibimi');
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
        Schema::dropIfExists('site_sakinleris');
    }
}
