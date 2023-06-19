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
                        ->where('id_role','!=',1)
                        ->count();
        $hitungKaryawanAlpha = Absent::join('users','users.id','=','absents.id_user')
                                    ->where('status','alpha')
                                    ->where('users.id_company',Auth::user()->id_company)
                                    ->whereRaw('date(absents.created_at) = CURRENT_DATE()')
                                    ->count();
        $hitungKaryawanHadir = Absent::join('users','users.id','=','absents.id_user')
                                    ->where('status','hadir')
                                    ->where('users.id_company',Auth::user()->id_company)
                                    ->whereRaw('date(absents.time_in) = CURRENT_DATE()')
                                    ->count();
        $hitungKaryawanCuti = Izin::selectRaw('izins.id_user')
                                    ->join('users','users.id','=','izins.id_user')
                                    ->where('users.id_company',Auth::user()->id_company)
                                    ->where('status','Setuju')
                                    ->whereRaw('CURRENT_DATE() <=date(izins.mulai) ')
                                    ->groupBy('izins.id_user')
                                    ->get();
        $hitungPermintaanCuti = Izin::selectRaw('izins.id_user,COUNT(*) as total')
                                    ->join('users','users.id','=','izins.id_user')
                                    ->where('users.id_company',Auth::user()->id_company)
                                    ->where('izins.status','Pending')
                                    ->groupBy('izins.id_user')
                                    ->count();
        return view('admin.IndexAdmin',compact('hitungKaryawan','hitungKaryawanAlpha','hitungKaryawanHadir','hitungKaryawanCuti','hitungPermintaanCuti'));
    }
}
