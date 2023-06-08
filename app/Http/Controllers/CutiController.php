<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Models\Izin;
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
        if(Izin::create($validated)){
            return redirect("/cuti")->with('success', 'Permintaan Cuti Sudah Dikirim');
        }else{
        }

    }
}
