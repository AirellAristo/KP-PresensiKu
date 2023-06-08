<?php

namespace App\Http\Controllers;

use App\Models\Absent;
use App\Models\Izin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataAbsensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $no = 1;
        $data = Absent::select()
                ->where('id_user',Auth::user()->id)
                ->where('status','hadir')
                ->get();
        return view('landingpage.section.data_absensi', compact('no', 'data'));
    }

    public function indexCuti()
    {
        $no = 1;
        $data = Izin::select()
                ->where('id_user',Auth::user()->id)
                ->where('status','Setuju')
                ->get();
        return view('landingpage.section.data_absensi_cuti', compact('no', 'data'));
    }

    public function indexAlpha()
    {
        $no = 1;
        $data = Absent::select()
                ->where('id_user',Auth::user()->id)
                ->where('status','alpha')
                ->get();
        return view('landingpage.section.data_absensi_alpha', compact('no', 'data'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
