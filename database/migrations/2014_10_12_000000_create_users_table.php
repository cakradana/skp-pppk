<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['Admin', 'Pegawai yang Dinilai', 'Pejabat Penilai', 'Atasan Pejabat Penilai']);
            $table->string('name');
            $table->string('nip')->unique();
            $table->foreignId('pangkat_id');
            $table->foreignId('jabatan_id');
            $table->foreignId('penilai_id')->nullable();
            $table->foreignId('atasan_id')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('foto')->nullable();
            $table->string('ttd')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
