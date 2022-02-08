<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Petugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['title'] = 'Petugas';
      $data['petugas'] = Petugas::getUserPetugas();
      return view('petugas.petugas',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function user(Request $request)
    {
        try {
            $data = [
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'user_id' =>  $request->id,
                'anggota_id' =>0,
                'role'=>'Petugas',
            ];
 
            $user = User::create($data);
            return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'User petugas dibuat']);
        } catch (QueryException $e) {
            return response()->json(['status'=>500,'title'=>'Query Error','text'=> $e->errorInfo]);
        }
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
                'nip' => $request->nip,
                'nama' => $request->nama,
                'jenis_kel' => $request->jenkel,
                'no_hp' => $request->hp,
                'alamat' => $request->alamat,
                'status' => $request->status
            ];
            Petugas::create($data);
            return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'Petugas Baru Ditambahkan']);
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
        $data =  Petugas::find($id);
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
        $data = Petugas::find($id);
        if ($data) {
            try {
                $data->update($request->all());
                return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'Petugas Diupdate']);
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
                'Petugas_id' => $request->user_id,
                'role'=>'Petugas',
            ];
 
            $user = User::create($data);
            return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'User Petugas dibuat']);
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
        $donasi = Petugas::find($id);
        if($donasi){
            try {
                $donasi->delete();
                return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'Petugas Dihapus']);
            } catch (QueryException $e) {
                return response()->json(['status'=>500,'title'=>'Query Error','text'=> $e->errorInfo]);
            }
        }else{
            return response()->json(['status'=>404,'title'=>'Not Found','text'=> 'Data Tidak Ditemukan']);
        }
    }
}
