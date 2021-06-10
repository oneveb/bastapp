<?php

namespace App\Http\Controllers;

use App\Models\DetailBast;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PDF;


class BastController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('bast.index', ['basts' => DB::table('no_bast')->paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('bast.buat');
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
        DB::table('no_bast')->insert(
            ['nomor' => $request->nomor, 'hari' => $request->total, 'tanggal' => $request->tanggal, 'nama_psatu' => $request->nama_psatu, 'jabatan_psatu' => $request->jabatan_psatu, "nip_psatu" => $request->nip_psatu, 'nama_pdua' => $request->nama_pdua, 'jabatan_pdua' => $request->jabatan_pdua, "nip_pdua" => $request->nip_pdua, 'total' => $request->total]
        );

        $count = count($request->jumlah);

        $data = array();
        for ($i=0; $i < $count; $i++) { 
            # code...
            $data[] = array('nomor'=> $request->nomor,'nama_barang' =>  $request->nama_barang[$i], 'banyak' => $request->banyak[$i], 'harga_satuan' => $request->harga_satuan[$i], 'jumlah' => $request->jumlah[$i], 'keterangan' => $request->keterangan[$i]);
        }

        DetailBast::insert($data);

        return redirect()->route('bast.index')->withStatus(__('Profile successfully updated.'));
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
        //z
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
        //
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
        DB::table('d_bast')->where('nomor', $id)->delete();
        DB::table('no_bast')->where('nomor', $id)->delete();
        return redirect()->back();
    }

    // print ke pdf
    public function print($id)
    {
        //
        $pdf = PDF::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream();
    }
}
