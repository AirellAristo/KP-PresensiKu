<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\User;
use Illuminate\Http\Request;


class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $no = 1;
        $data = Jabatan::select()
            ->where('id_jabatan', '!=', 1)
            ->get();

        $gaji = Jabatan::select('gaji')
            ->where('gaji', '!=', NULL)
            ->get();
        $formatted_gaji = [];
        foreach ($gaji as $gaji) {
            $formatted_gaji[] = $this->formatMoney($gaji->gaji);
        }

        return view('admin.jabatan.view', compact('no', 'data', 'formatted_gaji'));
    }

    public function formatMoney($amount)
    {
        $formattedAmount = 'Rp ' . number_format($amount, 2, ',', '.');

        return $formattedAmount;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jabatan.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jabatan' => 'required',
            'gaji' => 'required|numeric'
        ], [
            'jabatan.required' => 'Jabatan harus diisi',
            'gaji.required' => 'Gaji harus diisi',
            'gaji.numeric' => 'Gaji harus berupa angka'
        ]);

        Jabatan::create($validated);

        return redirect('/jabatan')->with('success', 'Data berhasil di Tambah');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function edit($id_jabatan)
    {
        $data = Jabatan::find($id_jabatan);

        return view('admin.jabatan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_jabatan)
    {
        $validated = $request->validate([
            'jabatan' => 'required',
            'gaji' => 'required|numeric'
        ], [
            'jabatan.required' => 'Jabatan harus diisi',
            'gaji.required' => 'Gaji harus diisi',
            'gaji.numeric' => 'Gaji harus berupa angka'
        ]);

        Jabatan::where('id_jabatan', $id_jabatan)->update($validated);

        return redirect('/jabatan')->with('success', 'Data berhasil di Tambah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jabatan  $jabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_jabatan)
    {
        User::where('id_jabatan',$id_jabatan)
            ->update(['id_jabatan'=>1]);
        Jabatan::destroy($id_jabatan);
        return redirect('/jabatan')->with('success', 'Data berhasil di Hapus');
    }
}
