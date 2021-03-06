<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Kategori;
use Auth;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Class constructor.
     */
    public function index()
    {
        if (!Auth::check()) {
            return redirect('login');
        } else {
            $data = Kategori::where('id_user', Auth::user()->id)->get();
            return view('kategori.index')->with('data', $data);
        }
    }

    public function create()
    {
        if (!Auth::check()) {
            return redirect('login');
        } else {
            return view('kategori.create');
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
        $data = new Kategori();
        $data->id_user = Auth::user()->id;
        $data->nama_kategori = $req->nama;
        $data->tipe = $req->tipe;
        $data->deskripsi = $req->deskripsi;
        $data->save();

        return redirect('kategori');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::check()) {
            return redirect('login');
        } else {
            $data = Kategori::find($id);

            return view('kategori.edit')->with('data', $data);
        }
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
        $data = Kategori::find($id);
        $data->id_user = Auth::user()->id;
        $data->nama_kategori = $req->nama;
        $data->tipe = $req->tipe;
        $data->deskripsi = $req->deskripsi;
        $data->save();

        return redirect('kategori');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $category = Kategori::find($id);
        $category->delete();

        return redirect('kategori');
    }
}
