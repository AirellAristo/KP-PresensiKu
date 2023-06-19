<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\company;
use App\Models\User;
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

    public function viewProfilePerusahaan()
    {
        $data = User::select('companies.company_name','users.id_company','users.email')
                    ->join('companies','companies.id_company','=','users.id_company')
                    ->where('users.id_company',Auth::user()->id_company)
                    ->get();
        return view('admin.setting.viewProfilePerusahaan',compact('data'));
    }

    public function viewEditProfilePerusahaan(){
        $data= User::select('companies.company_name','users.id_company','users.email','users.nomor_telepon')
                    ->join('companies','companies.id_company','=','users.id_company')
                    ->where('users.id_company',Auth::user()->id_company)
                    ->get();
        return view('admin.setting.editProfilePerusahaan',compact('data'));
    }

    public function editProfilePerusahaan(Request $request){
        $validated = $request->validate([
            'company_name' => 'required|unique:companies,company_name,'.Auth::user()->id_company.',id_company',
            'email' => 'required|unique:users,email,'.Auth::user()->id.',id',
        ]);
        if(User::where('id',Auth::id())->update(['email'=>$validated['email']])){
                if(company::where('id_company',Auth::user()->id_company)->update(['company_name'=>$validated['company_name']])){
                    return redirect('/setting/perusahaan')->with('success','Berhasil Edit Profile');
                }
                else{
                    return redirect('/setting/perusahaan')->with('error','Gagal Edit Profile');
                }
            }else{
                return redirect('/setting/perusahaan')->with('error','Gagal Edit Profile');
            }
        return view('admin.setting.editProfilePerusahaan');
    }
}
