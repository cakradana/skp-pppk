<?php

namespace App\Http\Controllers;

use App\Models\Sasaran;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class PengajuanRencanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        $disetujui = Sasaran::where('user_id', $user->id)->where('status', 'Disetujui')->get();
        if (count($disetujui) > 0) {
            $atribut = 'true';
        } else {
            $atribut = 'false';
        }

        $rencana = Sasaran::where('user_id', $user->id)->select(['kegiatan_id', 'output'])->groupBy(['kegiatan_id', 'output'])->get();

        return view('pengajuan.rencana.index', [
            "title" => "Rencana SKP",
            "user" => $user,
            "rencanas" => $rencana,
            "atribut" => $atribut
        ]);
    }

    public function cetak()
    {
        $user = auth()->user();

        $rencana = Sasaran::where('user_id', $user->id)->select(['kegiatan_id', 'output'])->groupBy(['kegiatan_id', 'output'])->get();

        $data = [
            "title" => "Cetak Rencana SKP",
            "user" => $user,
            "rencanas" => $rencana
        ];

        return view('pengajuan.rencana.cetak', $data);


        // $pdf = PDF::loadView('pengajuan.rencana.cetak', $data);
        // $pdf->setPaper('A4', 'landscape');
        // return $pdf->download('SKP ' . $user->name . '.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();

        // get all kegiatan where jabatan_id and not in rencana by user_id year
        $kegiatans = Kegiatan::where('jabatan_id', auth()->user()->jabatan_id)
            ->whereNotIn('id', function ($query) {
                $query->select('kegiatan_id')
                    ->from('sasarans')
                    ->where('user_id', auth()->user()->id)
                    ->whereYear('created_at', date('Y'));
            })
            ->get();

        return view('pengajuan.rencana.create', [
            "title" => "Tambah Rencana",
            "user" => $user,
            'kegiatans' => $kegiatans
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kegiatan_id' => ['required'],
            'kuantitas' => ['required'],
            'output' => ['required'],
            'bulan' => ['required']
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['penilai_id'] = auth()->user()->penilai_id;
        $validatedData['status'] = 'Belum Disetujui';
        $validatedData['realisasi'] = null;
        $validatedData['pengajuan_nilai'] = null;
        $validatedData['nilai_atasan'] = null;

        $bulans = $request->bulan;
        $kuantitases = $request->kuantitas;

        foreach ($bulans as $index => $bulan) {
            $kuantitas = $kuantitases[$index];
            $validatedData['bulan'] = $bulan;
            $validatedData['kuantitas'] = $kuantitas;
            Sasaran::create($validatedData);
        }

        return redirect('/pengajuan/rencana')->with('toast_success', 'Rencana Kegiatan telah berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sasaran  $sasaran
     * @return \Illuminate\Http\Response
     */
    public function show(Sasaran $sasaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sasaran  $sasaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Sasaran $sasaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sasaran  $sasaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sasaran $sasaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sasaran  $sasaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sasaran $sasaran)
    {
        //
    }
}
