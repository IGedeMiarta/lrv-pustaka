<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;

class RakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] =  'Rak';
        $data['rak'] = Rak::all();
        return view('buku.rak',$data);
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
        try {
            Rak::create($request->all());
            return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'Rak Baru Ditambahkan']);
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
       $data =  Rak::find($id);
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
        $data = Rak::find($id);
        if ($data) {
            try {
                $data->update($request->all());
                return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'Rak Diupdate']);
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
        $data = Rak::find($id);
        if ($data) {
            try {
                $data->delete();
                return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'Rak Dihapus']);
            } catch (QueryException $e) {
                return response()->json(['status'=>500,'title'=>'Query Error','text'=> $e->errorInfo]);
            }
        }else{
            return response()->json(['status'=>404,'title'=>'Not Found','text'=> 'Data Tidak Ditemukan']);
        }
    }
}
