<?php

namespace App\Http\Controllers;

use App\Models\DetailBuku;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Pengembalian';
        $data['peminjaman'] = Peminjaman::getAllPeminjamaActive();
        $data['pengembalian'] = Pengembalian::getAllPengembalian();
        // $data['buku']
        return view('pengembalian.pengembalian',$data);
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
        $tgl_kembali = date('Y-m-d');
        $peminjaman = $request->peminjaman;
        $status = $request->status;
        try {
            foreach ($peminjaman as $key => $value) {
                $data = [
                    'tgl_kembali' => $tgl_kembali,
                    'id_pinjam' => $peminjaman[$key],
                    'detail' => $status    
                ];
                Pengembalian::create($data);
                $peminjamans = Peminjaman::find($peminjaman[$key]);
                $peminjamans->update(['detail' => $status]);
                
                if ($status != 3) {
                   $detail = DetailBuku::find($peminjamans->isbn);
                   $detail->update(['status' => 1]);
                }
            }
            // print_r($test);
           return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'Buku Dikembalikan']);
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
