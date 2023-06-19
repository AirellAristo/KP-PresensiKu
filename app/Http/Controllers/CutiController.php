<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Izin;
use App\Models\Absent;
use App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CutiController extends Controller
{
    public function index()
    {
        $tanggalHariIni = Carbon::now()->format('Y-m-d');
        $no = 1;
        $data = Izin::select('mulai','akhir','keterangan','status','id_user')
                    ->where('id_user',Auth::user()->id)
                    ->where('status','Pending')
                    ->get();
        // dd(count($data),$data,Auth::user()->id);
        return view('employee.cuti.cutiIndex',compact('tanggalHariIni','data','no'));
    }

    public function cutiSetting(){

    }

    public function kirimCuti(Request $request){
        $idUser = Auth::user()->id;
        $validated = $request->validate([
            'mulai' => ['required'],
            'akhir' => ['required'],
            'keterangan' => ['required'],
        ]);
        $validated['id_user'] = $idUser;
        $validated['status'] = 'Pending';
        $checkPresensi =Absent::where('id_user',$idUser)
                        ->whereRaw('date(created_at) = CURRENT_DATE()')
                        ->count();
        if($checkPresensi == 0){
            if(Izin::create($validated)){
                return redirect("/cuti")->with('success', 'Permintaan Cuti Sudah Dikirim');
            }else{
                return redirect()->back()->with('error', 'Mohon Isi Semua Data');
            }
        }if($checkPresensi > 0){
                if ($validated['mulai'] > Carbon::now() || $validated['akhir'] > Carbon::now()){
                    if(Izin::create($validated)){
                        return redirect("/cuti")->with('success', 'Permintaan Cuti Sudah Dikirim');
                    }else{
                        return redirect()->back()->with('error', 'Mohon Isi Semua Data');
                    }
                }else{
                    return redirect()->back()->with('error', 'Data Presensi Sudah Diisi Hari Ini');
                }
        }else{
            return redirect()->back()->with('error', 'Kamu Harus Masuk Hari Ini');
        }
    }
}
