<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Account;

class UserController extends Controller
{

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect('home');
        }
        return view('user.register');
    }

    public function register(Request $req)
    {
        $req->validate(
            [
                'id_pengguna' => 'required|unique:users,username|regex:/^[0-9a-z]+$/',
                'name' => 'required',
                'pin' => 'required|numeric|digits:6'
            ]);
        
        try {
            DB::beginTransaction();

            $u = User::create([
                'name' => $req->name,
                'username' => $req->id_pengguna,
                'password' => \Hash::make($req->pin)
            ]);

            Account::create([
                'user_id' => $u->id
            ]);

            DB::commit();

            $kredensil = [
                'username' => $req->id_pengguna,
                'password' => $req->pin,
            ];
            
            if (Auth::attempt($kredensil)) {
                return redirect('home');
            }

        } catch (\Throwable $th) {
            DB::rollback();
            
            return redirect('register')->with('msg', ['danger', 'Gagal registrasi!']);
        }
        
    }

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('home');
        }
        return view('user.login');
    }

    public function login(Request $req)
    {
        $req->validate(
            [
                'id_pengguna' => 'required|unique:users,username|regex:/^[0-9a-z]+$/',
                'pin' => 'required|numeric|digits:6'
            ]);

        $kredensil = [
            'username' => $req->id_pengguna,
            'password' => $req->pin,
        ];

        if (Auth::attempt($kredensil)) {
            return redirect('home');
        }

        return redirect('login')->with('msg', ['danger', 'Gagal login, Id Pengguna atau PIN salah!'])->onlyInput('id_pengguna');
    }

    public function logout(Request $request)
    {
       $request->session()->flush();
       Auth::logout();
       return Redirect('login');
    }
}
