<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\Buku;
use App\Models\Donasi;
use App\Models\Donatur;
use App\Models\Kategori;
use App\Models\Penerbit;
use App\Models\Pengarang;
use App\Models\DetailBuku;
use App\Models\CodeBuilder;
use App\Models\DetailDonasi;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class DonasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Donasi';
        $data['donasi'] = Donasi::getAllDonasi();
        $data['donatur'] = Donatur::all();
        $data['kd_buku'] = CodeBuilder::kd_buku();
        $data['kd_pengarang'] =  CodeBuilder::kd_pengarang();
        $data['kd_penerbit'] =  CodeBuilder::kd_penerbit();
        $data['kd_kategori'] =  CodeBuilder::kd_kategori();
        $data['kategori'] = Kategori::all();
        $data['pengarang'] = Pengarang::all();
        $data['penerbit'] =Penerbit::all();
        $data['rak'] = Rak::all();
        // dd($data);
        return view('donasi.donasi',$data);
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
        $tanggal = date('Y-d-m');
        $donatur = $request->donatur;
        $jenis = $request->jenis;
        $keterangan = $request->ket;
        $status = $request->status;
        $jml_donasi = $request->jml;
        $buku =  $request->kd_buku;

        try {
            $data_dtl = [
                'keterangan' => $keterangan,
                'status' => $status
            ];
            $detail = DetailDonasi::create($data_dtl);
            $id = $detail->id_detail_donasi;
        
            if($jenis == 'uang'){
                $data_donasi = [
                    'tgl_donasi' => $tanggal,
                    'donatur' => $donatur,
                    'jml_donasi' => $jml_donasi,
                    'detail' => $id
                ];
                Donasi::create($data_donasi);
            }elseif($jenis == 'buku'){
                $data_donasi = [
                    'tgl_donasi' => $tanggal,
                    'donatur' => $donatur,
                    'jml_donasi' => null,
                    'buku'=>$buku,
                    'detail' => $id
                ];
                Donasi::create($data_donasi);
                $data = [
                    'kd_buku' => $request->kd_buku,
                    'judul' => $request->judul,
                    'pengarang' => $request->pengarang,
                    'penerbit' => $request->penerbit,
                    'th_terbit' => $request->tahun,
                    'kategori' => $request->kategori,
                    'status'=>1
                ];
                Buku::create($data);
                $data2 = [
                    'kd_detail' => $request->kd_buku. 'DTL1',
                    'kd_buku' => $request->kd_buku,
                    'tgl_masuk' => date('Y-m-d'),
                    'rak' => $request->rak,
                    'status' => 1
                ];

                DetailBuku::create($data2);
        }
            return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'Donasi Baru Ditambahkan']);
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
        $data = Donasi::with('donatur','detail','buku','buku.detail_buku')->where('id_donasi',$id)->first();
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
        $id_donasi = $request->id;
        $jenis = $request->jenis;
        $detail_donasi = $request->detail_donasi;
        $keterangan = $request->ket;
        $status = $request->status;
        try {
            
            $data_detail = [
                'keterangan' => $keterangan,
                'status'=>$status
            ];
            $details = DetailDonasi::find($detail_donasi);
            $details->update($data_detail);

            if ($jenis == 'uang') {
                $donatur = $request->donatur;
                $jml_donasi = $request->jml;
                $data = [
                    'donatur'=>$donatur,
                    'jml_donasi'=>$jml_donasi
                ];
                $dona = Donasi::find($id_donasi);
                $dona->update($data);
                
            }else{
                $isbn = $request->isbn;
                $judul = $request->judul;
                $pengarang = $request->pengarang;
                $penerbit = $request->penerbit;
                $tahun = $request->tahun;
                $kategori = $request->kategori;
                $data =[
                    'judul' => $judul,
                    'pengarang'=>$pengarang,
                    'penerbit'=>$penerbit,
                    'th_terbit'=>$tahun,
                    'kategori'=>$kategori
                ];
                $buku = Buku::find($isbn);
                $buku->update($data);

                $id_detail = $request->id_detail;
                $data2 =[
                    'rak' => $request->rak
                ];
                $detail2 = DetailBuku::find($id_detail);
                $detail2->update($data2);
            }

            return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'Donasi Diupdate']);
        } catch (QueryException $e) {
            return response()->json(['status'=>500,'title'=>'Query Error','text'=> $e->errorInfo]);
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
        $donasi = Donasi::find($id);
        if($donasi){
            try {
                $donasi->delete();
                return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'Donasi Dihapus']);
            } catch (QueryException $e) {
                return response()->json(['status'=>500,'title'=>'Query Error','text'=> $e->errorInfo]);
            }
        }else{
            return response()->json(['status'=>404,'title'=>'Not Found','text'=> 'Data Tidak Ditemukan']);
        }
    }
}
