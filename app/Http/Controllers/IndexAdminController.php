<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexAdminController extends Controller
{
    public function viewIndexAdmin()
    {
        $jumlahPermintaan = DB::table('izins')
                    ->where('status','Pending')
                    ->count();
        // session(['jumlahPermintaan' => $jumlahPermintaan]);
        return view('admin.layout.index');
    }
}
