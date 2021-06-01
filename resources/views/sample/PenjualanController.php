<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DetailPenjualan;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $penjualan = DB::table('penjualan')
            ->join('pelanggan', 'penjualan.id_pelanggan', 'pelanggan.id')
            ->get();

            // dd($penjualan);
        return view('penjualan.index', ['penjualan' => $penjualan]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $barang = DB::table('barang')->get();
        $pelanggan = DB::table('pelanggan')->get();
        $id = DB::table('penjualan')->max('nomor_struk') + 1;

        return view('penjualan.create', ['barang' => $barang, 'pelanggan' => $pelanggan, 'id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd($request);
        DB::table('penjualan')->insert(
            ['tanggal' => $request->tanggal, 'id_pelanggan' => $request->id_pelanggan, 'total' => $request->hasil]
        );
        
        $nomor_struk = DB::table('penjualan')->max('nomor_struk');
        
        $count = count($request->total);
        // dd($count);
        $data = array();
        for ($i=0; $i < $count; $i++) { 
            # code...
            $data[] = array('nomor_struk'=>$nomor_struk,'jumlah'=>$request->jumlah[$i],'total'=>$request->total[$i],'id_barang'=>$request->id_barang[$i]);
        }
        
        DetailPenjualan::insert($data);

        return redirect()->back();
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
        //
        $barang = DB::table('barang')->get();
        $pelanggan = DB::table('pelanggan')->get();
        $penjualan = DB::table('penjualan')
            ->join('pelanggan', 'penjualan.id_pelanggan', 'pelanggan.id')
            ->where('nomor_struk', $id)
            ->get();
        $detail = DB::table('detail_penjualan')
        ->join('barang', 'detail_penjualan.id_barang', 'barang.id')
        ->where('nomor_struk', $id)
        ->get();
        
        // dd($penjualan);
        $count = count($detail);

        return view('penjualan.edit', ['penjualan' => $penjualan,'detail' => $detail,'count' => $count,'barang' => $barang,'pelanggan' => $pelanggan]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //delete old
        DB::table('detail_penjualan')->where('nomor_struk', $id)->delete();
        DB::table('penjualan')->where('nomor_struk', $id)->delete();

        //insert new
        DB::table('penjualan')->insert(
            ['tanggal' => $request->tanggal, 'id_pelanggan' => $request->id_pelanggan, 'total' => $request->hasil]
        );
        
        $nomor_struk = DB::table('penjualan')->max('nomor_struk');
        
        $count = count($request->total);
        // dd($count);
        $data = array();
        for ($i=0; $i < $count; $i++) { 
            # code...
            $data[] = array('nomor_struk'=>$nomor_struk,'jumlah'=>$request->jumlah[$i],'total'=>$request->total[$i],'id_barang'=>$request->id_barang[$i]);
        }
        
        DetailPenjualan::insert($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // dd($id);
        DB::table('detail_penjualan')->where('nomor_struk', $id)->delete();
        DB::table('penjualan')->where('nomor_struk', $id)->delete();
        return redirect()->back();
    }
}
