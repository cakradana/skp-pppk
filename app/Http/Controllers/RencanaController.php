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
        $login = auth()->user();

        $disetujui = Rencana::where('user_id', $login->id)->where('status', 'disetujui')->get();
        if (count($disetujui) > 0) {
            $atribut = 'true';
        } else {
            $atribut = 'false';
        }

        // $rencana = Rencana::where('user_id', auth()->user()->id)->get();

        $rencana = Rencana::where('user_id', $login->id)->select(['kegiatan_id', 'output'])->groupBy(['kegiatan_id', 'output'])->get();

        // dd($rencana);

        // dd($waktu);

        return view('skp.rencana.index', [
            "title" => "Rencana SKP",
            "login" => $login,
            "rencanas" => $rencana,
            "atribut" => $atribut
        ]);
    }

    public function cetak()
    {
        $login = auth()->user();

        $rencana = Rencana::where('user_id', $login->id)->select(['kegiatan_id', 'output'])->groupBy(['kegiatan_id', 'output'])->get();

        $data = [
            "title" => "Cetak Rencana SKP",
            "login" => $login,
            "rencanas" => $rencana
        ];

        return view('skp.rencana.cetak', $data);


        // $pdf = PDF::loadView('skp.rencana.cetak', $data);
        // $pdf->setPaper('A4', 'landscape');
        // return $pdf->download('SKP ' . $login->name . '.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // get all kegiatan where jabatan_id and not in rencana by user_id year
        $kegiatans = Kegiatan::where('jabatan_id', auth()->user()->jabatan_id)
            ->whereNotIn('id', function ($query) {
                $query->select('kegiatan_id')
                    ->from('rencanas')
                    ->where('user_id', auth()->user()->id)
                    ->whereYear('created_at', date('Y'));
            })
            ->get();

        return view('skp.rencana.create', [
            "title" => "Tambah Kegiatan",
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
        $validatedData['status'] = 'belum disetujui';

        // dd($request[0]);

        foreach ($request->bulan as $index) {
            $validatedData['bulan'] = $index;
            Rencana::create($validatedData);
        }


        return redirect('/skp/rencana')->with('toast_success', 'Rencana Kegiatan telah berhasil ditambahkan!');
    }

    public function bulan(Request $request)
    {
        for ($i = 0; $i < $request->waktu; $i++) {
            Rencana::create([
                'kegiatan_id' => $request->kegiatan_id,
                'kuantitas' => $request->kuantitas,
                'output' => $request->output,
                'bulan' => $request->bulan[$i],
                'user_id' => $request->user_id,
                'penilai_id' => $request->penilai_id,
                'status' => $request->status
            ]);
        };

        return redirect('/skp/rencana')->with('toast_success', 'Rencana Kegiatan telah berhasil ditambahkan!');
    }

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
