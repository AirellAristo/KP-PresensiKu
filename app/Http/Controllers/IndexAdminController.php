<?php

namespace App\Http\Controllers;

use App\Models\Absent;
use App\Models\Izin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IndexAdminController extends Controller
{
    public function viewIndexAdmin()
    {
        $hitungKaryawan = User::where('id_company',Auth::user()->id_company)
                        ->count();
        $hitungKaryawanAlpha = Absent::where('status','alpha')
                            ->count();
        $hitungKaryawanHadir = Absent::where('status','hadir')
                            ->count();
        $hitungKaryawanCuti = Izin::where('status','Setuju')
                            ->count();
        $hitungPermintaanCuti = Izin::where('status','Pending')
        ->count();

        return view('admin.IndexAdmin',compact('hitungKaryawan','hitungKaryawanAlpha','hitungKaryawanHadir','hitungKaryawanCuti','hitungPermintaanCuti'));
    }
}
