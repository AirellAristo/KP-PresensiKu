<?php

namespace App\Http\Controllers;

use App\Models\Absent;
use App\Models\employeeSalary;
use App\Models\Izin;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class employeeSalaryController extends Controller
{

    public function viewGajiSaya(){
        $no = 1;
        $detailGajiKaryawan = employeeSalary::where('id_user',Auth::user()->id)
                                            ->get();
        return view('landingpage.section.riwayatGaji', compact('no','detailGajiKaryawan'));
    }

    public function viewGajiKaryawan(){
        $no = 1;
        $id_company = Auth::user()->id_company;
        // join('employee_salaries','employee_salaries.id_user','=','users.idx')
        $dataKaryawan = User::join('jabatans','jabatans.id_jabatan','=','users.id_jabatan')
                            ->where('users.id_company',$id_company)
                            ->where('users.id_role','!=',1)
                            ->get();
        $buktiBayarGaji = employeeSalary::join('users','users.id','=','employee_salaries.id_user')
                                        ->whereRaw("DATE_FORMAT(employee_salaries.created_at, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')")
                                        ->pluck('id')
                                        ->toArray();
        $fileBuktiBayarGaji = employeeSalary::join('users','users.id','=','employee_salaries.id_user')
                                        ->whereRaw("DATE_FORMAT(employee_salaries.created_at, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')")
                                        ->pluck('bukti_transfer_gaji','id')
                                        ->toArray();
        return view('admin.gajiKaryawan.viewGajiKaryawan',compact('dataKaryawan','no','buktiBayarGaji','fileBuktiBayarGaji'));
    }

    public function viewDetailGajiKaryawan($idKaryawan){
        $no = 1;
        $detailGajiKaryawan = employeeSalary::where('id_user',$idKaryawan)
                                            ->get();
        return view('admin.gajiKaryawan.viewDetailGajiKaryawan', compact('no','detailGajiKaryawan'));
    }

    public function viewBayarGajiKaryawan($idKaryawan){
        $cekJabatan =User::join('jabatans','jabatans.id_jabatan','=','users.id_jabatan')
                                        ->where('users.id',$idKaryawan)
                                        ->get();
        if(strtolower($cekJabatan[0]->jabatan) ==  "none"){
            return redirect('/gaji')->with('error','Set Jabatan Terlebih Dahulu');
        }else{
            $dataDiriKaryawan = User::join('jabatans','jabatans.id_jabatan','=','users.id_jabatan')
                                ->where('users.id',$idKaryawan)
                                ->get();
            $jumlahKehadiranPresensi = Absent::whereRaw("DATE_FORMAT(absents.created_at, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')")
                                            ->where('absents.id_user',$idKaryawan)
                                            ->where('status','hadir')
                                            ->count();
            $jumlahKehadiranAlpha = Absent::whereRaw("DATE_FORMAT(absents.created_at, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')")
                                            ->where('absents.id_user',$idKaryawan)
                                            ->where('status','alpha')
                                            ->count();
            $jumlahKehadiranIzin = Izin::whereRaw("DATE_FORMAT(izins.created_at, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')")
                                            ->where('izins.id_user',$idKaryawan)
                                            ->where('status','Setuju')
                                            ->count();
            $cekSudahBayar = employeeSalary::whereRaw("DATE_FORMAT(employee_salaries.created_at, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m')")
                                            ->where('employee_salaries.id_user',$idKaryawan)
                                            ->count();

            return view('admin.gajiKaryawan.bayarGajiKaryawan', compact('dataDiriKaryawan','jumlahKehadiranPresensi', 'jumlahKehadiranAlpha', 'jumlahKehadiranIzin','cekSudahBayar'));
        }

    }

    public function bayarGajiKaryawan(Request $request,$idKaryawan){
        $namaKaryawan = User::select('name','id')
                            ->where('id',$idKaryawan)
                            ->get();
        $waktu = Carbon::now();
        $month = $waktu->format('M-Y');
        $file = $request->file('bukti');
        $extension = $file->getClientOriginalExtension();
        $filename = 'bukti_slip_gaji-' . $namaKaryawan[0]->name . '-' . $month . '.' . $extension;
        $slipGaji = $file->storeAs('bukti_gaji', $filename);
        if($slipGaji){
            if(employeeSalary::create(['id_user' => $idKaryawan,
                                     'total_gaji' => $request->input('total_gaji'),
                                     'bukti_transfer_gaji' => $slipGaji
                                    ]))
                {
                    return redirect('/gaji')->with('success','Berhasil membayar gaji');
                }else{
                    return redirect('/gaji')->with('error','Gagal membayar gaji');
                }

        }else{
            return redirect('/gaji')->with('error','Gagal membayar gaji');
        }
    }


}
