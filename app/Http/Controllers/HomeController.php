<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Guest;
use Session;
use Auth;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect('login');
        } else {
            $data = Guest::get();
            return view('dashboard')->with('data', $data);
        }
    }
    // $response = Http::get('https://d.kapanlaginetwork.com/banner/test/province.json')->json();

    public function logout()
    {
        Auth::logout();
        return redirect('/login')->with('info', 'Logout successfully !');
    }
}
