<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Izin;
use App\Models\User;
use App\Models\Absent;
use App\Models\company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('landingpage.section.absensi');
    }



    public function bukaPresensi()
    {
        $check=Absent::select('absents.created_at')
                    ->join('users','users.id','=','absents.id_user')
                    ->where('id_company',Auth::user()->id_company)
                    ->whereRaw('date(absents.created_at) = CURRENT_DATE()')
                    ->count();
        $jumlahKaryawan = User::where('id_role','!=',1)
                            ->where('id_company',Auth::user()->id_company)
                            ->count();
        $jumlahKaryawanCuti = Izin::selectRaw('izins.id_user')
                                    ->join('users','users.id','=','izins.id_user')
                                    ->where('users.id_company',Auth::user()->id_company)
                                    ->where('status','Setuju')
                                    ->whereRaw('CURRENT_DATE() <=date(izins.mulai) ')
                                    ->groupBy('izins.id_user')
                                    ->get();
        if ($jumlahKaryawan > 0){
            if($jumlahKaryawan == count($jumlahKaryawanCuti)){
                return redirect('/setting')->with('error','Semua Karyawan Sedang Cuti');
            }else{
                if($check == 0){
                    $getIDUser = [];
                    $getIDIzin = [];
                    $users = User::select('id')
                        ->where('id_role', '!=', 1)
                        ->where('id_company',Auth::user()->id_company)
                        ->get();
                    $izin = Izin::select('id_user')
                        ->whereRaw('CURRENT_DATE <= date(akhir)')
                        ->where('status','Setuju')
                        ->get();
                    foreach($users as $idEmployee){
                        $getIDUser[] = $idEmployee->id;
                    };

                    foreach($izin as $idIzin){
                        $getIDIzin[] = $idIzin->id_user;
                    };

                    $result = array_diff($getIDUser, $getIDIzin);
                    foreach ($result as $presensi) {
                            $absent = new Absent();
                            $absent->id_user = $presensi;
                            $absent->status = 'alpha';
                            $absent->save();
                        }
                    company::where('id_company',Auth::user()->id_company)
                            ->update(['status' => 'buka']);
                    return redirect('/setting')->with('success','Berhasil Membuka Presensi');
                }else{
                    return redirect('/setting')->with('error','Anda Sudah Membuka Presensi Hari Ini');
                }
                }

        }else{
            return redirect('/setting')->with('error','Anda Belum Memiliki Karyawan');
        }

    }

    public function tutupPresensi(){
        company::where('id_company',Auth::user()->id_company)
                    ->update(['status' => 'tutup']);
        return redirect('/setting')->with('success','Berhasil Menutup Presensi');
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
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function show(Absent $absent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function absent(Request $request)
    {
        $user = Auth::user();

        // Cek apakah user sudah absent hari ini
        $check = company::select('*')
                        ->where('id_company',$user->id_company)
                        ->get();
        $absent = Absent::where('id_user', $user->id)
            ->where('time_in', '!=', NULL)
            ->first();
        if($check[0]->updated_at < Carbon::now() && $check[0]->status == 'tutup' ){
            return redirect('/absent')->with('error', 'Presensi sudah ditutup');
        }else{
            if ($absent) {
                return redirect('/absent')->with('error', 'Anda sudah Absent hari ini');
            } else {
                // dd('masuk else',$user->id);
                $validated = $request->validate([
                    'keterangan' => 'required'
                ], [
                    'keterangan.required' => 'Mohon Keterangan untuk diisi'
                ]);

                $validated['status'] = 'hadir';
                $validated['time_in'] = Carbon::now();

                Absent::where('id_user', $user->id)
                    ->whereRaw('date(created_at) = CURRENT_DATE()')
                    ->update($validated);
                return redirect('/absent')->with('success', 'Absent berhasil');
            }
        }


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Absent $absent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Absent  $absent
     * @return \Illuminate\Http\Response
     */
    public function destroy(Absent $absent)
    {
        //
    }
}
