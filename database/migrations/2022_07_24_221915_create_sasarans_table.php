<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSasaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sasarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('kegiatan_id');
            $table->integer('kuantitas');
            $table->integer('realisasi')->nullable();
            $table->string('output');
            $table->string('bulan');
            $table->enum('status', ['Disetujui', 'Belum Disetujui']);
            $table->float('pengajuan_nilai')->nullable();
            $table->float('nilai_atasan')->nullable();
            $table->foreignId('penilai_id');
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
        Schema::dropIfExists('sasarans');
    }
}
