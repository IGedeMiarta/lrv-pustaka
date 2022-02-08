<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\CodeBuilder;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Buku';
        $data['book'] = Buku::getAllBook();
        $data['rak'] = Rak::all();
        $data['kode_buku'] = CodeBuilder::kd_buku();
        $data['pengarang'] = Pengarang::all();
        $data['penerbit'] = Penerbit::all();
        $data['kategori'] = Kategori::all();
        return view('buku.buku',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function buku($id)
    {
        $kd = Buku::find($id);
        $data = [
            'isbn'=>$id,
            'id'=>$kd->kd_buku,
            'kd'=>CodeBuilder::kd_detail($id)
        ];
        return response()->json(['status'=>200,'data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Buku::create($request->all());
            return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'Buku Baru Ditambahkan']);
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
       $data =  Buku::find($id);
        if ($data) {
            return response()->json(['status'=>200,'title'=>'Success','data'=>$data]);
        }else{
            return response()->json(['status'=>400,'title'=>'Not Found']);
        }
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
        $data = Buku::find($id);
        if ($data) {
            try {
                $data->update($request->all());
                return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'Buku Diupdate']);
            } catch (QueryException $e) {
                return response()->json(['status'=>500,'title'=>'Query Error','text'=> $e->errorInfo]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Buku::find($id);
        if ($data) {
            try {
                $data->delete();
                return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'Buku Dihapus']);
            } catch (QueryException $e) {
                return response()->json(['status'=>500,'title'=>'Query Error','text'=> $e->errorInfo]);
            }
        }else{
            return response()->json(['status'=>404,'title'=>'Not Found','text'=> 'Data Tidak Ditemukan']);
        }
    }
}
