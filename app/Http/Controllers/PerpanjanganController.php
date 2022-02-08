<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Perpanjangan;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class PerpanjanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Perpanjangan';
        $data['perpanjangan'] = Perpanjangan::getAllPerpanjangan();
        $data['peminjaman'] = Peminjaman::getAllPeminjamanTerpinjam();
        return view('perpanjangan.perpanjangan',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tgl_perpanjang = date('Y-m-d');
        $peminjaman = $request->peminjaman;
        $batas_pinjam = date("Y-m-d", strtotime("$tgl_perpanjang + 7 days"));
        try {
            foreach ($peminjaman as $key => $value) {
                $cek = Peminjaman::find($peminjaman[$key]);
                $id = $cek->id_anggota;
                $anggota = Anggota::find($id);
                if ($anggota) {
                    $data_pemijam = [
                            'batas_pinjam' => $batas_pinjam,
                            'tgl_perpanjang' => $tgl_perpanjang,
                            'detail' => 4
                        ];
                    $cek->update($data_pemijam);
                    $data_perpanjang = [
                        'tgl_perpanjangan' => $tgl_perpanjang,
                        'id_peminjaman' => $peminjaman[$key],
                        'batas_kembali' => $batas_pinjam,
                        'detail' => 4                    
                    ];
                    Perpanjangan::create($data_perpanjang);
                }
            }
         return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'Buku diperpanjang']);
        } catch (QueryException $e) {
            return response()->json(['status'=>500,'title'=>'Query Error','text'=> $e->errorInfo]);
        }
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
    }
}
