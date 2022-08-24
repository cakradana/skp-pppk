<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\Pangkat;
use App\Models\Penilai;
use App\Models\Atasan;
use App\Models\Kegiatan;
use App\Models\Output;
use App\Models\Rencana;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Pangkat::create([
            'nama' => 'Tenaga Kependidikan, X'
        ]);

        Pangkat::create([
            'nama' => 'Penata Muda, III/a'
        ]);

        Pangkat::create([
            'nama' => 'Pembina Tingkat I, IV/b'
        ]);

        /////////////////////////////////////////////////////

        Jabatan::create([
            'nama' => 'Ahli Pertama - Pranata Laboratorium Pendidikan'
        ]);

        Jabatan::create([
            'nama' => 'Analis Sumber Daya Manusia Aparatur'
        ]);

        Jabatan::create([
            'nama' => 'Ketua Jurusan Teknik Informatika'
        ]);

        Jabatan::create([
            'nama' => 'Direktur'
        ]);

        Jabatan::create([
            'nama' => 'Arsiparis Ahli Pertama'
        ]);

        ///////////////////////////////////////////////////////////////////

        Kegiatan::create([
            'jabatan_id' => '1',
            'nama' => 'Merencanakan program pemeliharaan/perawatan dan penyimpanan peralatan kategori 1 (satu)',
            'ak' => '0.25'
        ]);

        Kegiatan::create([
            'jabatan_id' => '1',
            'nama' => 'Merencanakan program pemeriksaan dan kalibrasi pealatan kategori 1 (satu)',
            'ak' => '0.16'
        ]);

        Kegiatan::create([
            'jabatan_id' => '1',
            'nama' => 'Menyusun kebutuhan peralatan pada kegiatan pendidikan kategori 1 (satu)',
            'ak' => '0.12'
        ]);

        Kegiatan::create([
            'jabatan_id' => '1',
            'nama' => 'Menyusun kebutuhan bahan umum pada kegiatan pendidikan',
            'ak' => '0.09'
        ]);

        Kegiatan::create([
            'jabatan_id' => '1',
            'nama' => 'Menyusun jadwal pemeliharaan/perawatan peralatan kategori 2 (dua);',
            'ak' => '0.2'
        ]);

        Kegiatan::create([
            'jabatan_id' => '5',
            'nama' => 'Menyeleksi arsip inaktif yang akan dimusnahkan;',
            'ak' => '0.2'
        ]);
        Kegiatan::create([
            'jabatan_id' => '5',
            'nama' => 'Melakukan laminasi arsip peta dan kearsitekturan;',
            'ak' => '0.2'
        ]);
        Kegiatan::create([
            'jabatan_id' => '5',
            'nama' => 'Melakukan identifikasi dan pengolahan data arsip inaktif;',
            'ak' => '0.2'
        ]);



        //////////////////////////////////////////////////////////////////

        User::create([
            'role' => 'Pegawai yang Dinilai',
            'name' => 'Andriansyah Zakaria, S.Kom., M.Kom.',
            'nip' => '198507252021211003',
            'pangkat_id' => 1,
            'jabatan_id' => 1,
            'penilai_id' => 3,
            'atasan_id' => 4,
            'password' => bcrypt('12345')
        ]);

        User::create([
            'role' => 'Admin',
            'name' => 'Eka Kusuma Wardani, S.E.',
            'nip' => '198402172019032011',
            'pangkat_id' => 2,
            'jabatan_id' => 2,
            'password' => bcrypt('12345')
        ]);

        /////////////////////////////////////////////////////////////////////////////////////////

        User::create([
            'role' => 'Pejabat Penilai',
            'name' => 'Nur Wahyu Rahadi, S.Kom., M.Eng.',
            'nip' => '198105092021211004',
            'pangkat_id' => 1,
            'jabatan_id' => 3,
            'atasan_id' => 4,
            'password' => bcrypt('12345')
        ]);

        User::create([
            'role' => 'Atasan Pejabat Penilai',
            'name' => 'Dr.Ir. Aris Tjahyanto, M.Kom.',
            'nip' => '196503101991021001',
            'pangkat_id' => 3,
            'jabatan_id' => 4,
            'password' => bcrypt('12345')
        ]);

        ///////////////////////////////////////////////////////////////////////////////////////////

        User::create([
            'role' => 'Pegawai yang Dinilai',
            'name' => 'Sriworo Werdiningsih, S.E.',
            'nip' => '198412302021212003',
            'pangkat_id' => 2,
            'jabatan_id' => 5,
            'penilai_id' => 3,
            'atasan_id' => 4,
            'password' => bcrypt('12345')
        ]);

        ////////////////////////////////////////////////////////////////////////////////////////////

        Output::create([
            'nama' => 'Dokumen'
        ]);
    }
}
