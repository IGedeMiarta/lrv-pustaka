<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use App\Models\DetailAnggota;
use App\Models\StatusAnggota;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Kartu Anggota';
        $data['anggota'] = Anggota::getUserAnggota();
        $data['status'] = StatusAnggota::all();
        return view('anggota.anggota',$data);
    
    }
    public function kartu(){
        $data['title'] = 'Anggota';
        $data['anggota'] = Anggota::getUserAnggota();
        return view('anggota.anggota-c',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function cetak($id)
    {
        $data['anggota'] = Anggota::find($id);
        return view('anggota.cetak',$data);
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
             $data = [
                'nis' => $request->nis,
                'nama' => $request->nama,
                'jenis_kel' => $request->jenkel,
                'no_hp' => $request->hp,
                'alamat' => $request->alamat,
                'status' => $request->status
            ];
            Anggota::create($data);
            return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'Anggota Baru Ditambahkan']);
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
        $data =  Anggota::find($id);
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
        $data = Anggota::find($id);
        if ($data) {
            try {
                $data->update($request->all());
                return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'Anggota Diupdate']);
            } catch (QueryException $e) {
                return response()->json(['status'=>500,'title'=>'Query Error','text'=> $e->errorInfo]);
            }
        }
    }

    public function users(Request $request){
       
        try {
            $data = [
                'username' => $request->email,
                'password' => Hash::make($request->password),
                'user_id' => 0,
                'anggota_id' => $request->user_id,
                'role'=>'Anggota',
            ];
 
            $user = User::create($data);
            return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'User anggota dibuat']);
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
        $donasi = Anggota::find($id);
        if($donasi){
            try {
                $donasi->delete();
                return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'Anggota Dihapus']);
            } catch (QueryException $e) {
                return response()->json(['status'=>500,'title'=>'Query Error','text'=> $e->errorInfo]);
            }
        }else{
            return response()->json(['status'=>404,'title'=>'Not Found','text'=> 'Data Tidak Ditemukan']);
        }
    }
}
