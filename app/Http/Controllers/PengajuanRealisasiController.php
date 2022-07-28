<?php

namespace App\Http\Controllers;

use App\Models\Sasaran;
use Illuminate\Http\Request;

class PengajuanRealisasiController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $disetujui = Sasaran::where('user_id', $user->id)->where('status', 'Disetujui')->get();

        if (count($disetujui) > 0) {
            $atribut = 'true';
        } else {
            $atribut = 'false';
        }

        $rencana = Sasaran::where('user_id', $user->id)->select(['kegiatan_id', 'output_id', 'realisasi_kuantitas'])->groupBy(['kegiatan_id', 'output_id', 'realisasi_kuantitas'])->get();

        return view('pengajuan.realisasi.index', [
            "title" => "Pengajuan Realisasi SKP",
            "user" => $user,
            "rencanas" => $rencana,
            "atribut" => $atribut
        ]);
    }

    public function search(Request $request)
    {
        // dd($request->all());


        $user = auth()->user();

        $bulan = $request->bulan;

        if ($bulan == "Semua Bulan") {
            $rencanas = Sasaran::where('user_id', $user->id)->get();
        } else {
            $rencanas = Sasaran::where('user_id', $user->id)->where('bulan', $bulan)->get();
        }

        return view('pengajuan.realisasi.create', compact('rencanas'), [
            "user" => $user,
            "selected" => $bulan,
            "title" => "Realisasi SKP " . $bulan
        ]);
    }

    public function create()
    {
        $user = auth()->user();

        $rencana = Sasaran::where('user_id', $user->id)->get();

        // dd($rencana);

        return view('pengajuan.realisasi.create', [
            "title" => "Isi Realisasi Per Bulan",
            "user" => $user,
            "selected" => "Semua Bulan",
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

        $rules = [
            'realisasi_kuantitas' => ['required'],
            'pengajuan_nilai' => ['required'],
        ];


        $validatedData = $request->validate($rules);

        $validatedData['realisasi_biaya'] = $request->realisasi_biaya;

        Sasaran::where('id', $id)->update($validatedData);

        return redirect('/pengajuan/realisasi/create')->with('toast_success', 'Realiasasi telah berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        //
    }
}
