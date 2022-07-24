<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Rencana;
use Illuminate\Http\Request;
use PDF;

class RencanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
                    ->from('rencanas')
                    ->where('user_id', auth()->user()->id)
                    ->whereYear('created_at', date('Y'));
            })
            ->get();

        return view('pengajuan.rencana.create', [
            "title" => "Tambah Rencana",
            "user" => $user,
            // 'kegiatans' => Kegiatan::where('jabatan_id', auth()->user()->jabatan_id)->get()
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
        // dd($request->all());

        // $request->validate([
        //     'bulan' => 'required'
        // ]);

        $validatedData = $request->validate([
            'kegiatan_id' => ['required'],
            'kuantitas' => ['required'],
            'output' => ['required'],
            'bulan' => ['required']
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['penilai_id'] = auth()->user()->penilai_id;
        $validatedData['status'] = 'Belum Disetujui';

        // dd($request[0]);

        $bulans = $request->bulan;
        $kuantitases = $request->kuantitas;

        foreach ($bulans as $index => $bulan) {
            $kuantitas = $kuantitases[$index];
            $validatedData['bulan'] = $bulan;
            $validatedData['kuantitas'] = $kuantitas;
            Rencana::create($validatedData);
        }

        return redirect('/pengajuan/rencana')->with('toast_success', 'Rencana Kegiatan telah berhasil ditambahkan!');
    }

    // public function bulan(Request $request)
    // {
    //     for ($i = 0; $i < $request->waktu; $i++) {
    //         Rencana::create([
    //             'kegiatan_id' => $request->kegiatan_id,
    //             'kuantitas' => $request->kuantitas,
    //             'output' => $request->output,
    //             'bulan' => $request->bulan[$i],
    //             'user_id' => $request->user_id,
    //             'penilai_id' => $request->penilai_id,
    //             'status' => $request->status
    //         ]);
    //     };

    //     return redirect('/pengajuan/rencana')->with('toast_success', 'Rencana Kegiatan telah berhasil ditambahkan!');
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
