<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\company;
use Illuminate\Support\Facades\Auth;

class SettingController extends Controller
{
    public function viewSetting()
    {
        $companyStatus = company::select('status')
                                ->where('id_company',Auth::user()->id_company)
                                ->get();
        return view('settingAdmin',compact('companyStatus'));
    }

    public function aturanCuti()
    {

    }
}
