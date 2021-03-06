<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Guest;

class FrontController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $province = Http::get('https://d.kapanlaginetwork.com/banner/test/province.json')->json();
        $city = Http::get('https://d.kapanlaginetwork.com/banner/test/city.json')->json();
        return view('front.index', compact('province', 'city'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $data = new Guest();
        $data->first_name = $req->first_name;
        $data->last_name = $req->last_name;
        $data->organization = $req->organization;
        $data->address = $req->address;
        $data->city = $req->city;
        $data->province = $req->province;
        $data->save();

        return redirect()->back();
    }
}
