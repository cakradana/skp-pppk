<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRencanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rencanas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('kegiatan_id');
            $table->integer('kuantitas');
            $table->string('output');
            $table->string('bulan');
            $table->foreignId('penilai_id');
            $table->enum('status', ['disetujui', 'belum disetujui']);
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
        Schema::dropIfExists('rencanas');
    }
}
