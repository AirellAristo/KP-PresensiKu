<?php

namespace App\Http\Controllers;

use App\Models\Absent;
use App\Models\Izin;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use app\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $no = 1;
        $perusahaan = Auth::user()->id_company;
        $dataKaryawan = User::with('jabatan')
            ->select()
            ->where('id_role', '!=', 1)
            ->where('id_company', $perusahaan)
            ->get();

        $jabatan = Jabatan::all();
        // dd($dataKaryawan);
        return view('admin.karyawan.view', compact('no', 'perusahaan', 'dataKaryawan', 'jabatan'));
    }

    public function viewKaryawan($id_karyawan)
    {
        $dataDiriKaryawan = User::select()
                            ->join('jabatans','jabatans.id_jabatan','=','users.id_jabatan')
                            ->where('id',$id_karyawan)
                            ->where('id_company',Auth::user()->id_company)
                            ->get();


        //  dd($dataDiriKaryawan);
        return view('admin.karyawan.viewDetail',compact('dataDiriKaryawan'));
    }

    public function viewKaryawanKehadiran($id_karyawan)
    {
        $no = 1;
        $dataDiriKaryawan = User::select()
                            ->join('jabatans','jabatans.id_jabatan','=','users.id_jabatan')
                            ->where('id',$id_karyawan)
                            ->where('id_company',Auth::user()->id_company)
                            ->get();
        $data = DB::table('absents')
                ->where('id_user',$id_karyawan)
                ->where('status','hadir')
                ->get();
        // dd($dataDiriKaryawan);
        return view('admin.karyawan.viewDetailKehadiran',compact('dataDiriKaryawan','data','no'));
    }

    public function viewKaryawanCuti($id_karyawan){
        $no = 1;
        $dataDiriKaryawan = User::select()
                            ->join('jabatans','jabatans.id_jabatan','=','users.id_jabatan')
                            ->where('id',$id_karyawan)
                            ->where('id_company',Auth::user()->id_company)
                            ->get();
        $data = DB::table('izins')
                ->where('id_user',$id_karyawan)
                ->get();
        return view('admin.karyawan.viewDetailCuti',compact('dataDiriKaryawan','data','no'));
    }

    public function viewKaryawanAlpha($id_karyawan){
        $no = 1;
        $dataDiriKaryawan = User::select()
                            ->join('jabatans','jabatans.id_jabatan','=','users.id_jabatan')
                            ->where('id',$id_karyawan)
                            ->where('id_company',Auth::user()->id_company)
                            ->get();
        $data = DB::table('absents')
                ->where('id_user',$id_karyawan)
                ->where('status','alpha')
                ->get();
        // dd($dataDiriKaryawan);
        return view('admin.karyawan.viewDetailAlpha',compact('dataDiriKaryawan','data','no'));
    }

    public function viewPermintaanCuti (){
        $no = 1;
        $data = Izin::select('users.id','users.name','users.id_company','izins.mulai','izins.akhir','izins.keterangan','izins.status','jabatans.jabatan')
                        ->join('users','users.id','=','izins.id_user')
                        ->join('jabatans','jabatans.id_jabatan','=','users.id_jabatan')
                        ->where('users.id_company',Auth::user()->id_company)
                        ->where('izins.status','Pending')
                        ->get();
        // dd($data);
        return view('admin.karyawan.viewPermintaanCuti',compact('data','no'));
    }

    public function updateStatusCuti(Request $request,$id_karyawan)
    {
        // dd($request->input('status'),$id_karyawan);
        $jumlahPermintaan = DB::table('izins')
                    ->where('status','Pending')
                    ->count();
        $status = $request->input('status');
        if(Izin::where('id_user',$id_karyawan)->update(['status' => $status])){
            session(['jumlahPermintaan' => $jumlahPermintaan]);
            return redirect('/karyawan/cuti')->with('success','Berhasil Mengganti Status Cuti Menjadi '.$status);
        }else{
            session(['jumlahPermintaan' => $jumlahPermintaan]);
            return redirect('/karyawan/cuti')->with('error','Ada Kesalahan Dalam Mengganti Status Menjadi'.$status);
        }
    }

    public function update(Request $request, $id)
    {
        User::where('id', $id)->update(['id_jabatan' => $request->input('jabatan')]);

        return redirect('/karyawan');
    }


}
