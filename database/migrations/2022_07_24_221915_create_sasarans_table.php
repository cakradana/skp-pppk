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
            $table->integer('target_kuantitas');
            $table->integer('realisasi_kuantitas')->nullable();

            $table->float('target_kualitas');
            $table->float('pengajuan_nilai')->nullable();

            $table->foreignId('output_id');
            $table->string('bulan');

            $table->integer('target_biaya')->nullable();
            $table->integer('realisasi_biaya')->nullable();

            $table->enum('status', ['Disetujui', 'Belum Disetujui']);

            $table->float('realisasi_kulitas')->nullable();
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
