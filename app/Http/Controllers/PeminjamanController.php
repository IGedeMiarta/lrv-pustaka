<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Buku;
use App\Models\DetailBuku;
use App\Models\Peminjaman;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Peminjaman';
        $data['peminjaman'] = Peminjaman::getAllPeminjaman();
        $data['code'] = Peminjaman::makeCode();
        $data['anggota'] = Anggota::all();
        $data['buku'] = Buku::getAllAvailableBook();

        return view('peminjaman.peminjaman',$data);
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
        // print_r($request->all());
        $tgl_pinjam = date('Y-m-d');
        $anggota = $request->anggota;
        $kode = $request->code;
        $buku = $request->buku;
        $batas_pinjam = date("Y-m-d", strtotime("$tgl_pinjam + 7 days"));
        $detail = 1; #status dipinjam
        $peminjaman = Peminjaman::countPeminjamanAnggota($anggota);
        if ($peminjaman >= 3) {
           return response()->json(['status'=>Response::HTTP_UNAUTHORIZED,'title'=> 'Melebihi Batas Peminjaman','text'=>'Sudah Meminjam '.$peminjaman.' Buku']);
        }
        try {
           foreach ($buku as $key => $value) {
               $data = [
                   'kd_peminjaman'=>$kode,
                   'tgl_pinjam'=>$tgl_pinjam,
                   'isbn' => $buku[$key],
                   'id_anggota'=>$anggota,
                   'batas_pinjam'=>$batas_pinjam,
                   'detail'=>1
               ];
               Peminjaman::create($data);
               $detail = DetailBuku::find($buku[$key]);
               $detail->update(['status' => 0]);
           }
           return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'Peminjaman Baru Ditambahkan']);
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
