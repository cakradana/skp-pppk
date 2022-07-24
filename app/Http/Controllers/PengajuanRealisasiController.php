<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sasaran;
use App\Models\Realisasi;
use Exception;

class PengajuanRealisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() //BELUM BERHASIL
    {
        $user = auth()->user();

        $disetujui = Sasaran::where('user_id', $user->id)->where('status', 'Disetujui')->get();

        if (count($disetujui) > 0) {
            $atribut = 'true';
        } else {
            $atribut = 'false';
        }

        $rencana = Sasaran::where('user_id', $user->id)->select(['kegiatan_id', 'output'])->groupBy(['kegiatan_id', 'output'])->get();

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

        // echo ('tes');

        // $search = $_GET['bulan'];
        // $pilih_bulan = Sasaran::where('bulan', 'LIKE', '%' . $search . '%')->get();

        // dd($search);

        return view('pengajuan.realisasi.create', compact('rencanas'), [
            "user" => $user,
            "selected" => $bulan,
            "title" => "Realisasi SKP " . $bulan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();

        $rencana = Sasaran::where('user_id', $user->id)->get();

        // $realisasi = Realisasi::where('')
        // dd($rencana);

        return view('pengajuan.realisasi.create', [
            "title" => "Isi Realisasi Per Bulan",
            "user" => $user,
            "selected" => "Semua Bulan",
            "rencanas" => $rencana
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Models\Jabatan  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Models\Jabatan  $request
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $rules = [
            'realisasi' => ['required'],
            'pengajuan_nilai' => ['required']
        ];

        $validatedData = $request->validate($rules);

        // dd($validatedData);
        // dd($id);

        Sasaran::where('id', $id)->update($validatedData);

        return redirect('/pengajuan/realisasi/create')->with('toast_success', 'Realiasasi telah berhasil ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
