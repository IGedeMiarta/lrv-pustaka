<?php

namespace App\Http\Controllers;

use App\Models\Penerbit;
use App\Models\CodeBuilder;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;

class PenerbitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = 'Penerbit';
        $data['penerbit'] = Penerbit::all();
        $data['kd_penerbit'] =  CodeBuilder::kd_penerbit();
        return view('buku.penerbit',$data);

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
            Penerbit::create($request->all());
            return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'Penerbit Baru Ditambahkan']);
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
       $data =  Penerbit::find($id);
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
        $data = Penerbit::find($id);
        if ($data) {
            try {
                $data->update($request->all());
                return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'Penerbit Diupdate']);
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
        $data = Penerbit::find($id);
        if ($data) {
            try {
                $data->delete();
                return response()->json(['status'=>Response::HTTP_CREATED,'title'=>'Success','text'=>'Penerbit Dihapus']);
            } catch (QueryException $e) {
                return response()->json(['status'=>500,'title'=>'Query Error','text'=> $e->errorInfo]);
            }
        }else{
            return response()->json(['status'=>404,'title'=>'Not Found','text'=> 'Data Tidak Ditemukan']);
        }
    }
}
