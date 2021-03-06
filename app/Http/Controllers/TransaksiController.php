<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaksi;
use App\Kategori;
use Auth;
use DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function tipe($id = 0)
    {
        if ($id == 1) {
            $obj['data'] = DB::table('kategori')->where('tipe', 'pemasukan')->get();
        } else if ($id == 2) {
            $obj['data'] = DB::table('kategori')->where('tipe', 'pengeluaran')->get();
        }

        return response()->json($obj);
    }

    public function index()
    {
        if (!Auth::check()) {
            return redirect('login');
        } else {
            $data = Transaksi::orderBy('created_at')->get();

            return view('transaksi.index')->with('data', $data);
        }
    }

    function fetch_data(Request $request)
    {
        if ($request->ajax()) {
            if ($request->start != '' && $request->end != '') {
                $data = DB::table('transaksi')
                    ->whereBetween('created_at', array($request->start, $request->end))
                    ->get();
            } else {
                $data = DB::table('transaksi')->orderBy('updated_at', 'desc')->get();
            }
            echo json_encode($data);
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
            return view('transaksi.create');
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
        $data = new Transaksi();
        $data->id_kategori = $req->type_kategori;
        $data->id_user = Auth::user()->id;
        $data->tipe = $req->type_transaksi;
        $data->nominal = $req->nominal;
        $data->deskripsi = $req->deskripsi;
        $data->save();

        return redirect('transaksi');
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
        if (!Auth::check()) {
            return redirect('login');
        } else {
            $data = DB::table('transaksi')
                ->join('kategori', 'kategori.id_kategori', 'transaksi.id_kategori')
                ->select('*', 'kategori.id_kategori as kategori_id', 'nama_kategori')
                ->first();

            return view('transaksi.edit')->with('data', $data);
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
        $data = Transaksi::find($id);
        $data->id_kategori = $req->type_kategori;
        $data->id_user = Auth::user()->id;
        $data->tipe = $req->type_transaksi;
        $data->nominal = $req->nominal;
        $data->deskripsi = $req->deskripsi;
        $data->save();

        return redirect('transaksi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->delete();

        return redirect('transaksi');
    }
}
