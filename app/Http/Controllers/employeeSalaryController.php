<?php

namespace App\Http\Controllers;

use App\Models\employeeSalary;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class employeeSalaryController extends Controller
{


    public function viewGajiKaryawan(){
        $no = 1;
        $id_company = Auth::user()->id_company;
        // join('employee_salaries','employee_salaries.id_user','=','users.idx')
        $dataKaryawan = User::join('jabatans','jabatans.id_jabatan','=','users.id_jabatan')
                            ->where('users.id_company',$id_company)
                            ->where('users.id_role','!=',1)
                            ->get();
        $buktiBayarGaji = employeeSalary::join('users','users.id','=','employee_salaries.id_user')
                                        ->whereRaw("DATE_FORMAT(employee_salaries.created_at, '%Y-%m') = DATE_FORMAT(CURDATE(), '%Y-%m');")
                                        ->pluck('id')
                                        ->toArray();
        return view('admin.gajiKaryawan.viewGajiKaryawan',compact('dataKaryawan','no','buktiBayarGaji'));
    }
}
