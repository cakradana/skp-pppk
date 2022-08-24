<?php

namespace App\Http\Controllers;

use App\Models\Sasaran;
use App\Models\Nilai;
use Illuminate\Http\Request;

class PengajuanRealisasiController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $disetujui = Sasaran::where('user_id', $user->id)->where('status', 'Disetujui')->get()->count();

        $belum_dinilai = Sasaran::where('user_id', $user->id)->where('realisasi_kualitas', null)->get()->count();

        if ($belum_dinilai == 0) {
            $cetak = 'bisa cetak';
        } else {
            $cetak = 'belum bisa cetak';
        }

        if ($disetujui > 0) {
            $atribut = 'true';
        } else {
            $atribut = 'false';
        }

        $rencanas = Sasaran::where('user_id', $user->id)->select(['kegiatan_id', 'output_id', 'target_kualitas', 'target_biaya'])
            ->groupBy(['kegiatan_id', 'output_id', 'target_kualitas', 'target_biaya'])->get();


        $total_nilai = 0;
        $banyak_kegiatan = \App\Models\Sasaran::where('user_id', $user->id)
            ->select('kegiatan_id')
            ->groupBy('kegiatan_id')
            ->get()
            ->count();

        $array_target_kuantitas = [];
        $array_realisasi_kuantitas = [];
        $array_target_waktu = [];
        $array_realisasi_waktu = [];
        $array_realisasi_kualitas = [];
        $array_target_biaya = [];
        $array_realisasi_biaya = [];
        $array_nilai_skp = [];

        foreach ($rencanas as $rencana) {

            $target_kuantitas = \App\Models\Sasaran::where('user_id', $user->id)
                ->where('kegiatan_id', $rencana->kegiatan_id)
                ->select('target_kuantitas', $rencana->kuantitas)
                ->sum('target_kuantitas');

            array_push($array_target_kuantitas, $target_kuantitas);

            $realisasi_kuantitas = \App\Models\Sasaran::where('user_id', $user->id)
                ->where('kegiatan_id', $rencana->kegiatan->id)
                ->sum('realisasi_kuantitas');

            array_push($array_realisasi_kuantitas, $realisasi_kuantitas);

            $target_waktu = \App\Models\Sasaran::where('user_id', $user->id)
                ->where('kegiatan_id', $rencana->kegiatan_id)
                ->count();

            array_push($array_target_waktu, $target_waktu);

            $realisasi_waktu = \App\Models\Sasaran::where('user_id', $user->id)
                ->where('kegiatan_id', $rencana->kegiatan_id)
                ->whereNotNull('realisasi_kuantitas')
                ->count();

            array_push($array_realisasi_waktu, $realisasi_waktu);

            $realisasi_kualitas = \App\Models\Sasaran::where('user_id', $user->id)
                ->where('kegiatan_id', $rencana->kegiatan_id)
                ->whereNotNull('realisasi_kualitas')
                ->value('realisasi_kualitas');

            array_push($array_realisasi_kualitas, $realisasi_kualitas);

            $target_biaya = \App\Models\Sasaran::where('user_id', $user->id)
                ->where('kegiatan_id', $rencana->kegiatan_id)
                ->whereNotNull('target_biaya')
                ->value('target_biaya');

            array_push($array_target_biaya, $target_biaya);

            $realisasi_biaya = \App\Models\Sasaran::where('user_id', $user->id)
                ->where('kegiatan_id', $rencana->kegiatan_id)
                ->whereNotNull('realisasi_biaya')
                ->value('realisasi_biaya');

            array_push($array_realisasi_biaya, $realisasi_biaya);

            $aspek_kuantitas = ($realisasi_kuantitas / $target_kuantitas) * 100;
            $aspek_kualitas = ($realisasi_kualitas / $rencana->target_kualitas) * 100;

            $persen_waktu = 100 - ($realisasi_waktu / $target_waktu) * 100;
            if ($persen_waktu > 24) {
                $aspek_waktu = 76 - (((1.76 * $target_waktu - $realisasi_waktu) / $target_waktu) * 100 - 100);
            } elseif ($persen_waktu < 24) {
                $aspek_waktu = ((1.76 * $target_waktu - $realisasi_waktu) / $target_waktu) * 100;
            }

            if (!empty($target_biaya)) {
                $persen_biaya = 100 - ($realisasi_biaya / $target_biaya) * 100;
                if ($persen_biaya > 24) {
                    $aspek_biaya = 76 - (((1.76 * $target_biaya - $realisasi_biaya) / $target_biaya) * 100 - 100);
                } elseif ($persen_biaya < 24) {
                    $aspek_biaya = ((1.76 * $target_biaya - $realisasi_biaya) / $target_biaya) * 100;
                }
            } else {
                $persen_biaya = null;
                $aspek_biaya = null;
            }

            $perhitungan = $aspek_kuantitas + $aspek_kualitas + $aspek_waktu + $aspek_biaya;

            if (!empty($target_biaya)) {
                if ($realisasi_biaya == null) {
                    $nilai_skp = $perhitungan / 3;
                    array_push($array_nilai_skp, $nilai_skp);
                } else {
                    $nilai_skp = $perhitungan / 4;
                    array_push($array_nilai_skp, $nilai_skp);
                }
            } else {
                $nilai_skp = $perhitungan / 3;
                array_push($array_nilai_skp, $nilai_skp);
            }
            $total_nilai += $nilai_skp;

            $final = $total_nilai / $banyak_kegiatan;
        }

        $nilaiData['nilai_skp'] = round($final, 2);

        // dd($nilaiData);

        Nilai::where('user_id', $user->id)->update($nilaiData);

        // dd($final);
        return view('pengajuan.realisasi.index', [
            "title" => "Pengajuan Realisasi SKP",
            "user" => $user,
            "final" => $final,
            "target_kuantitas" => $array_target_kuantitas,
            "realisasi_kuantitas" => $array_realisasi_kuantitas,
            "target_waktu" => $array_target_waktu,
            "realisasi_waktu" => $array_realisasi_waktu,
            "realisasi_kualitas" => $array_realisasi_kualitas,
            "target_biaya" => $array_target_biaya,
            "realisasi_biaya" => $array_realisasi_biaya,
            "nilai_skp" => $array_nilai_skp,
            "rencanas" => $rencanas,
            "atribut" => $atribut,
            "cetak" => $cetak
        ]);
    }

    public function cetak()
    {
        $user = auth()->user();

        $rencana = Sasaran::where('user_id', $user->id)->select(['kegiatan_id', 'output_id', 'target_biaya', 'target_kualitas'])->groupBy(['kegiatan_id', 'output_id', 'target_biaya', 'target_kualitas'])->get();

        $data = [
            "title" => "Cetak Rencana SKP",
            "user" => $user,
            "rencanas" => $rencana
        ];

        return view('pengajuan.realisasi.cetak', $data);
    }

    public function create(Request $request)
    {
        $user = auth()->user();

        $bulan = $request->bulan;

        if ($bulan == "Semua Bulan" || $bulan == null) {
            $rencana = Sasaran::where('user_id', $user->id)->get();
            $bulan = "Semua Bulan";
        } else {
            $rencana = Sasaran::where('user_id', $user->id)->where('bulan', $bulan)->get();
        }

        // dd($rencana);

        return view('pengajuan.realisasi.create', [
            "title" => "Isi Realisasi Per Bulan",
            "user" => $user,
            "selected" => $bulan,
            "rencanas" => $rencana
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        // $rules = [
        //     'rencana_id' => 'required',
        //     'realisasi' => 'required',
        //     'pengajuan_nilai' => 'required',
        //     // 'nilai_atasan' => ['required']
        // ];

        // $validatedData = $request->validate($rules);
        // $validatedData['user_id'] = auth()->user()->id;
        // $validatedData['nilai_atasan'] = null;

        // Sasaran::create($validatedData);

        // return redirect('/pengajuan/realisasi/create')->with('toast_success', 'Realiasasi telah berhasil ditambahkan!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        // 
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());

        $bulan = $request->bulan;

        $rules = [
            'realisasi_kuantitas' => ['required'],
            'pengajuan_nilai' => ['required'],
        ];


        $validatedData = $request->validate($rules);

        $validatedData['realisasi_biaya'] = $request->realisasi_biaya;

        Sasaran::where('id', $id)->update($validatedData);

        return redirect('/pengajuan/realisasi/create')->with('toast_success', 'Realiasasi telah berhasil ditambahkan!');
    }

    public function reset($id)
    {
        // dd($request->all());

        $validatedData['realisasi_biaya'] = null;
        $validatedData['pengajuan_nilai'] = null;
        $validatedData['realisasi_kuantitas'] = null;

        // dd($validatedData);

        Sasaran::where('id', $id)->update($validatedData);

        return redirect('/pengajuan/realisasi/create')->with('toast_success', 'Realiasasi telah berhasil direset!');
    }

    public function destroy($id)
    {
        //
    }
}
