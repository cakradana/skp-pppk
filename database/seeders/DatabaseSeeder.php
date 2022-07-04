<?php

namespace Database\Seeders;

use App\Models\Jabatan;
use App\Models\Pangkat;
use App\Models\Penilai;
use App\Models\Atasan;
use App\Models\Kegiatan;
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
            'nama' => 'Penata Tingkat I, III/d'
        ]);

        Pangkat::create([
            'nama' => 'Pembina, IV/a'
        ]);

        Pangkat::create([
            'nama' => 'Pembina Tingkat I, IV/b'
        ]);

        /////////////////////////////////////////////////////

        Jabatan::create([
            'nama' => 'Ahli Pertama - Pranata Laboratorium Pendidikan'
        ]);

        Jabatan::create([
            'nama' => 'Analis Kepegawaian Ahli Muda'
        ]);

        Jabatan::create([
            'nama' => 'Wakil Direktur Bidang Umum dan Keuangan'
        ]);

        Jabatan::create([
            'nama' => 'Ketua Jurusan Teknik Informatika'
        ]);

        Jabatan::create([
            'nama' => 'Direktur'
        ]);

        ///////////////////////////////////////////////////////////////////

        Kegiatan::create([
            'jabatan_id' => '1',
            'nama' => 'Merencanakan program pemeliharaan/perawatan dan penyimpanan peralatan kategori 1 (satu)',
            'ak' => '0.25'
        ]);

        Kegiatan::create([
            'jabatan_id' => '2',
            'nama' => 'Menganalisis jabatan yang meliputi uraian jabatan, syarat jabatan, dan peta jabatan serta kekuatan pegawai yang menghasilkan informasi jabatan',
            'ak' => '0.1'
        ]);

        Kegiatan::create([
            'jabatan_id' => '2',
            'nama' => 'Melaksanakan pengumpulan data, dengan: Mengumpulkan data pegawai tahun berjalan, untuk mengetahui pegawai yang pensiun meninggal dunia, naik pangkat, pindah instansi, maupun berhenti',
            'ak' => '0.01'
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

        //////////////////////////////////////////////////////////////////

        User::create([
            'role' => 'Pegawai yang Dinilai',
            'name' => 'Andriansyah Zakaria, S.Kom.,M.Kom.',
            'nip' => '198507252021211003',
            'pangkat_id' => 1,
            'jabatan_id' => 1,
            'penilai_id' => 3,
            'atasan_id' => 5,
            'password' => bcrypt('12345')
        ]);

        User::create([
            'role' => 'Pegawai yang Dinilai',
            'name' => 'Siti Markhatun, S.H.',
            'nip' => '196906111993032005',
            'pangkat_id' => 2,
            'jabatan_id' => 2,
            'penilai_id' => 4,
            'atasan_id' => 5,
            'password' => bcrypt('12345')
        ]);

        /////////////////////////////////////////////////////////////////////////////////////////

        User::create([
            'role' => 'Pejabat Penilai',
            'name' => 'Nur Wahyu Rahadi, S.Kom., M.Eng.',
            'nip' => '198105092021211004',
            'pangkat_id' => 1,
            'jabatan_id' => 4,
            'atasan_id' => 5,
            'password' => bcrypt('12345')
        ]);

        User::create([
            'role' => 'Pejabat Penilai',
            'name' => 'Dadang Hermawan, S.E., M.Si.',
            'nip' => '195908041988121001',
            'pangkat_id' => 3,
            'jabatan_id' => 3,
            'atasan_id' => 5,
            'password' => bcrypt('12345')
        ]);

        ///////////////////////////////////////////////////////////////////////////////////////////

        User::create([
            'role' => 'Atasan Pejabat Penilai',
            'name' => 'Dr.Ir. Aris Tjahyanto, M.Kom.',
            'nip' => '196503101991021001',
            'pangkat_id' => 4,
            'jabatan_id' => 5,
            'password' => bcrypt('12345')
        ]);

        ///////////////////////////////////////////////////////////////////////////////////////////

        User::create([
            'role' => 'Admin',
            'name' => 'R. Cakradana',
            'nip' => '190202064',
            'pangkat_id' => 4,
            'jabatan_id' => 5,
            'password' => bcrypt('12345')
        ]);

        ////////////////////////////////////////////////////////////////////////////////////////////

        // Rencana::create([
        //     'user_id' => '1',
        //     'kegiatan_id' => '1',
        //     'kuantitas' => '2',
        //     'output' => 'Dokumen',
        //     'waktu' => '1',
        //     'penilai_id' => '3',
        //     'status' => 'belum disetujui'
        // ]);

        // \App\Models\User::factory(10)->create();
    }
}
