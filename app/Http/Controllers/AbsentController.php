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
        $user = Auth::user();
        $company = company::select('longitude', 'latitude', 'id_company')
            ->where('id_company', $user->id_company)
            ->get();
            return view('landingpage.section.absensi', compact('company'));
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

    public function viewLupaPresensiEmpl(){
        $dataAlpha = Absent::where('absents.status','Alpha')
                            ->where('absents.keterangan',null)
                            ->where('absents.time_in',null)
                            ->where('absents.id_user',Auth::user()->id)
                            ->whereRaw('date(absents.created_at) < CURRENT_DATE()')
                            ->get();

        return view('landingpage.section.lupa_present_karyawan',  compact('dataAlpha'));
    }

    public function kirimLupaPresensiEmpl(Request $request){
        $validated = $request->validate([
            'id' => 'numeric'
        ], [
            'id.numeric' => 'Mohon untuk Memilih Data Alpha'
        ]);

        $test = Absent::where('id',$validated['id'])
                ->update(['keterangan' => $request->input('keterangan')]);
        if($test){
            return redirect('/lupaPresensi')->with('success','Berhasil Mengirim Pengajuan');
        }else{
            return redirect('/lupaPresensi')->with('error','Gagal Mengirim Pengajuan');
        }
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
            ->whereRaw('date(created_at) = CURRENT_DATE()')
            ->first();
        if($request->input('distance') < 15){
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
        }else{
            return redirect('/absent')->with('error', 'Anda terlalu jauh dari lokasi');
        }

    }

}
