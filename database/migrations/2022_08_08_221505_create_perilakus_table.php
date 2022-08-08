<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerilakusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perilakus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('penilai_id');
            $table->double('orientasi_palayanan');
            $table->double('integritas');
            $table->double('komitmen');
            $table->double('kerjasama');
            $table->double('kepemimpinan');
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
        Schema::dropIfExists('perilakus');
    }
}
