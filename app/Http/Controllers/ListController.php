<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Guest;
use Session;
use Auth;
use DB;

class ListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect('login');
        } else {
            $data = Guest::get();
            return view('dashboard')->with('data', $data);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!Auth::check()) {
            return redirect('login');
        } else {
            $province = Http::get('https://d.kapanlaginetwork.com/banner/test/province.json')->json();
            $city = Http::get('https://d.kapanlaginetwork.com/banner/test/city.json')->json();
            return view('create')->with('city', $city)->with('province', $province);
        }
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

        return redirect('list');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Guest::find($id);
        $province = Http::get('https://d.kapanlaginetwork.com/banner/test/province.json')->json();
        $city = Http::get('https://d.kapanlaginetwork.com/banner/test/city.json')->json();
        return view('edit', compact('data', 'city', 'province'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $data = Guest::find($id);
        $data->first_name = $req->first_name;
        $data->last_name = $req->last_name;
        $data->organization = $req->organization;
        $data->address = $req->address;
        $data->city = $req->city;
        $data->province = $req->province;
        $data->save();

        return redirect('list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Guest::find($id);
        $data->delete();
        return redirect('list');
    }
}
