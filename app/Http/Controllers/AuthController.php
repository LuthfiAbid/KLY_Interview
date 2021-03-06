<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Validator;
use App\User;
use Session;
use Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function login()
    {
        if(Auth::check()){
            return redirect('list');
        }
        return view('login');
    }
    public function loginPost(Request $req)
    {
        $validator = [
            'email' => 'required|email',
            'password' => 'required|string'
        ];

        $message = [
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Input email tidak valid!',
            'password.required' => 'Password harus diisi!',
            'password.string' => 'Password tidak valid!'
        ];

        $check = Validator::make($req->all(), $message, $validator);

        if($check->fails()){
            return redirect()->back()->withErrors($validator)->withInput($req->all);
        }

        $data = [
            'email' => $req->email,
            'password' => $req->password,
        ];

        Auth::attempt($data);

        if(Auth::check()){
            return redirect('list');
        }else{
            Session::flash('error', 'Email atau password salah!');
            return redirect()->route('login');
        }
    }

    public function register()
    {
        return view('register');
    }

    public function registerPost(Request $req)
    {
        $validator = [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed'
        ];

        $message = [
            'name.required' => 'Nama harus diisi!',
            'name.min' => 'Nama harus lebih dari 3 karakter!',
            'email.required' => 'Email harus diisi!',
            'email.email' => 'Input email tidak valid!',
            'email.unieuq' => 'Email telah digunakan!',
            'password.required' => 'Password harus diisi!',
            'password.confirmed' => 'Password tidak sama dengan konfirmasi!'
        ];

        $check = Validator::make($req->all(), $message, $validator);

        if($check->fails()){
            return redirect()->back()->withErrors($check)->withInput($req->all);
        }

        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = bcrypt(trim($req->password));
        $user->email_verified_at = \Carbon\Carbon::now();
        $simpan = $user->save();

        if($simpan){
            Session::flash('success', 'Register berhasil! Silahkan login');
            return redirect()->route('login');
        }else{
            Session::flash('error',['' => 'Register gagal! silahkan register ulang']);
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
