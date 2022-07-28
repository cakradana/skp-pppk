<?php

namespace App\Http\Controllers;

use App\Models\Sasaran;
use App\Models\Kegiatan;
use App\Models\Output;
use Illuminate\Http\Request;

class PengajuanRencanaController extends Controller
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

        $rencana = Sasaran::where('user_id', $user->id)->select(['kegiatan_id', 'output_id'])->groupBy(['kegiatan_id', 'output_id'])->get();

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

        $rencana = Sasaran::where('user_id', $user->id)->select(['kegiatan_id', 'output_id', 'target_biaya'])->groupBy(['kegiatan_id', 'output_id', 'target_biaya'])->get();

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

    public function create()
    {
        $user = auth()->user();

        $output = Output::all();

        // get all kegiatan where jabatan_id and not in rencana by user_id year
        $kegiatan = Kegiatan::where('jabatan_id', auth()->user()->jabatan_id)
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
            "outputs" => $output,
            "kegiatans" => $kegiatan
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'kegiatan_id' => ['required'],
            'target_kualitas' => ['required'],
            'target_kuantitas' => ['required'],
            // 'target_biaya' => ['required'],
            'output_id' => ['required'],
            'bulan' => ['required']
        ]);

        // dd($validatedData);

        // $num = $request->target_biaya;
        // $int = toInt();

        // dd($int);

        // $validatedData['target-biaya'] = $int;

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['penilai_id'] = auth()->user()->penilai_id;
        $validatedData['status'] = 'Belum Disetujui';
        $validatedData['realisasi_kuantitas'] = null;
        $validatedData['realisasi_biaya'] = null;
        $validatedData['pengajuan_nilai'] = null;
        $validatedData['realisasi_kualitas'] = null;

        // dd($validatedData);

        $bulans = $request->bulan;
        $kuantitases = $request->target_kuantitas;

        foreach ($bulans as $index => $bulan) {
            $kuantitas = $kuantitases[$index];
            $validatedData['bulan'] = $bulan;
            $validatedData['target_kuantitas'] = $kuantitas;
            Sasaran::create($validatedData);
        }

        return redirect()->back()->with('toast_success', 'Rencana Kegiatan telah berhasil ditambahkan!');
    }

    public function show(Sasaran $sasaran)
    {
        //
    }

    public function edit(Sasaran $sasaran)
    {
        //
    }

    public function update(Request $request, Sasaran $sasaran)
    {
        //
    }

    public function destroy($id)
    {
        $user = auth()->user();

        Sasaran::where('user_id', $user->id)->where('kegiatan_id', $id)->delete();

        return redirect()->back()->with('toast_success', 'Rencana telah berhasil dihapus!');
    }

    public function tambahOutput(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => ['required', 'unique:outputs']
        ]);

        Output::create($validatedData);

        return redirect()->back()->with('toast_success', 'Output telah berhasil ditambahkan!');
    }

    public function tambahKegiatan(Request $request)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'nama' => ['required', 'unique:kegiatans'],
            'jabatan_id' => ['required'],
            'ak' => ['required'],
        ]);

        Kegiatan::create($validatedData);

        return redirect()->back()->with('toast_success', 'Kegiatan telah berhasil ditambahkan!');
    }
}
