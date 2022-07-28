<?php

namespace App\Http\Controllers;

use App\Models\Output;
use Illuminate\Http\Request;

class OutputController extends Controller
{
    public function index()
    {
        $output = Output::all();

        return view('master.output.index', [
            "title" => "Master Output",
            "outputs" => $output
        ]);
    }

    public function create()
    {
        return view('master.output.create', [
            "title" => "Tambah Output"
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => ['required', 'unique:outputs']
        ]);

        Output::create($validatedData);

        return redirect('/master/output')->with('toast_success', 'Output telah berhasil ditambahkan!');
    }

    public function show(Output $output)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Output  $output
     * @return \Illuminate\Http\Response
     */
    public function edit(Output $output)
    {
        return view('master.output.edit', [
            "title" => "Edit Output",
            'output' => $output
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Output  $output
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Output $output)
    {
        $rules = [
            'nama' => ['required', 'unique:outputs']
        ];

        $validatedData = $request->validate($rules);

        Output::where('id', $output->id)->update($validatedData);

        return redirect('/master/output')->with('toast_success', 'Output telah berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Output  $output
     * @return \Illuminate\Http\Response
     */
    public function destroy(Output $output)
    {
        Output::destroy($output->id);

        return redirect('/master/output')->with('toast_success', 'Output telah berhasil dihapus!');
    }
}
