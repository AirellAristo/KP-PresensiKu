<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LupaPresentController extends Controller
{
    public function viewLupaPresensiEmpl(){
        return view('landingpage.section.lupa_present_karyawan');
    }
}
