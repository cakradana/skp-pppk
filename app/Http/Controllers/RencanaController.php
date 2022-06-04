<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use App\Models\Rencana;
use Illuminate\Http\Request;

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

        $rencana = Rencana::where('user_id', $login->id)->where('status', 'disetujui')->get();
        if (count($rencana) > 0) {
            $atribut = 'true';
        } else {
            $atribut = 'false';
        }

        // dd($rencana);

        return view('skp.rencana.index', [
            "title" => "Rencana SKP",
            "rencanas" => Rencana::where('user_id', auth()->user()->id)->get(),
            "atribut" => $atribut
        ]);
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
        $validatedData = $request->validate([
            'kegiatan_id' => ['required'],
            'kuantitas' => ['required'],
            'output' => ['required'],
            'waktu' => ['required'],
        ]);

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['penilai_id'] = auth()->user()->penilai_id;
        $validatedData['status'] = 'belum disetujui';

        Rencana::create($validatedData);

        return redirect('/skp/rencana')->with('success', 'Rencana Kegiatan telah berhasil ditambahkan!');
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
