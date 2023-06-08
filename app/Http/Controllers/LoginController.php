<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\company;
use Faker\Provider\ar_EG\Company as Ar_EGCompany;

class LoginController extends Controller
{
    public function index()
    {
        return view('admin.auth.login');
    }

    public function indexRegisAdmin()
    {
        return view('admin.auth.register');
    }

    public function indexRegisEmployee()
    {
        return view('employee.auth.register');
    }

    public function registrasiAdmin(Request $request){
        $id_role = 1;
        $idCompany = Str::random(1).uniqid();
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'max:100', 'email', 'unique:users,email'],
            'password' => ['required'],
            'company_name' => ['required', 'string', 'max:100', 'unique:companies,company_name']
        ]);

        // if($request->validate()) {
            $company = company::create([
                'id_company' => $idCompany,
                'company_name' => $request->input('company_name')
            ]);

            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'id_company' => $idCompany,
                'id_role'=> $id_role,
                'password' => Hash::make($request['password']),
                'id_jabatan' => 1,
            ]);
        // }

        return redirect('/login');
    }

    public function registrasiEmployee(Request $request){
        $id_role = 2;
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'max:100', 'email', 'unique:users,email'],
            'password' => ['required'],
            'id_company' => ['required', 'string', 'max:100', 'exists:companies,id_company']
        ]);
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'id_company' => $request['id_company'],
            'id_role'=> $id_role,
            'password' => Hash::make($request['password']),
            'id_jabatan' => 1,
        ]);

        return redirect('/login');
    }

    public function login(Request $request){
        //dd($request);
        $credentials = $request->validate([
            'email' => ['required', 'string', 'max:100', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)){
            if(Auth::user()->id_role == 1){
                $request->session()->regenerate();
                return redirect()->intended('/admin');
            }
            if(Auth::user()->id_role == 2){
                $request->session()->regenerate();
                return redirect()->intended('/absent');
            }
        }
        return back()->withErrors([
            'email' => 'Email and Password invalid'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
