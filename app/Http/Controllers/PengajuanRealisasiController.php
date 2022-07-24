<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rencana;
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

        $disetujui = Rencana::where('user_id', $user->id)->where('status', 'disetujui')->get();

        if (count($disetujui) > 0) {
            $atribut = 'true';
        } else {
            $atribut = 'false';
        }

        // $rencana = Rencana::where('user_id', auth()->user()->id)->get();

        $rencanas = Rencana::where('user_id', $user->id)->select(['id', 'kegiatan_id', 'output'])->groupBy(['id', 'kegiatan_id', 'output'])->get();
        // $realisasis[0] = Realisasi::where('rencana_id', $rencanas[0]->id)->first();
        // $n = 1;

        $rencanas = Rencana::join('realisasis', 'rencanas.id', 'realisasis.rencana_id')
            ->where('rencanas.user_id', $user->id)
            ->select(['rencanas.id', 'rencanas.kegiatan_id', 'rencanas.output', 'realisasis.*'])
            ->groupBy(['rencana_id'])
            ->get();
        dd($rencanas);

        // foreach ($rencanas->skip(1) as $rencana) {
        //     $realisasis[$n] = Realisasi::orWhere('rencana_id', $rencana->id);
        //     // $realisasis->push($realisasi);

        //     $n++;
        // }

        // dd('ok');
        // dd($realisasis);


        return view('skp.realisasi.index', [
            "title" => "Pengajuan Realisasi SKP",
            "user" => $user,
            // "realisasis" => $realisasis,
            "rencanas" => $rencanas,
            "atribut" => $atribut
        ]);
    }

    public function search(Request $request)
    {
        // dd($request->all());


        $user = auth()->user();

        $bulan = $request->bulan;

        if ($bulan == "Semua Bulan") {
            $rencanas = Rencana::where('user_id', $user->id)->select(['id', 'kegiatan_id', 'kuantitas', 'output', 'bulan'])->groupBy(['id', 'kegiatan_id', 'kuantitas', 'output', 'bulan'])->get();
        } else {
            $rencanas = Rencana::where('user_id', $user->id)->select(['id', 'kegiatan_id', 'kuantitas', 'output', 'bulan'])->groupBy(['id', 'kegiatan_id', 'kuantitas', 'output', 'bulan'])->where('bulan', $bulan)->get();
        }

        // echo ('tes');

        // $search = $_GET['bulan'];
        // $pilih_bulan = Rencana::where('bulan', 'LIKE', '%' . $search . '%')->get();

        // dd($search);

        return view('skp.realisasi.create', compact('rencanas'), [
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

        $rencana = Rencana::where('user_id', $user->id)->select(['id', 'kegiatan_id', 'kuantitas', 'output', 'bulan'])->groupBy(['id', 'kegiatan_id', 'kuantitas', 'output', 'bulan'])->get();

        // $realisasi = Realisasi::where('')
        // dd($rencana);

        return view('skp.realisasi.create', [
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
        // dd($request->all());
        // $validatedData = [];
        // try {
        $rules = [
            'rencana_id' => 'required',
            'realisasi' => 'required',
            'pengajuan_nilai' => 'required',
            // 'nilai_atasan' => ['required']
        ];

        $validatedData = $request->validate($rules);

        $validatedData['nilai_atasan'] = null;
        Realisasi::create($validatedData);
        // } catch (Exception $e) {
        //     // dd($e->getMessage());
        //     // dd($validatedData);
        //     return redirect('/skp/realisasi')->with('toast_error', 'Realiasasi telah gagal ditambahkan!');
        // }


        // dd($validatedData);


        // dd($request[0]);

        return redirect('/skp/realisasi/create')->with('toast_success', 'Realiasasi telah berhasil ditambahkan!');
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
        // 
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
