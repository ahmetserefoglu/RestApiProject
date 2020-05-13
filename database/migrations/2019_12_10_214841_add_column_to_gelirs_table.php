<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToGelirsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gelirs', function (Blueprint $table) {
            //
            $table->string('gelir_adi');
            $table->string('gelir_kisi');
            $table->float('gelir_miktar', 8, 2);
            $table->date('gelir_tarih');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('gelirs', function (Blueprint $table) {
            //
        });
    }
}
