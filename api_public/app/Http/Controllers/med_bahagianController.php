<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_bahagian;

class med_bahagianController extends Controller
{
    public function register(Request $request) {
        $nama_bahagian = $request->input('nama_bahagian');
        $kod_bahagian = $request->input('kod_bahagian');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');
        $statusrekod = $request->input('statusrekod');

        $register = med_bahagian::create([
            'nama_bahagian' => $nama_bahagian,
            'kod_bahagian' => $kod_bahagian,
            'created_by' => $created_by,
            'updated_by' => $updated_by,
            'statusrekod' => $statusrekod
        ]);

        if ($register)  {
            return response()->json([
                'success'=>'true',
                'message'=>'Register Success!',
                'data'=>$register
            ],201);
        }

        else    {
            return response()->json([
                'success'=>'false',
                'message'=>'Tak Jadi Boss',
                'data'=>$register
            ],405);
        }
    }

    public function show(Request $request)  {
        $id = $request->input('id_bahagian');

        $med_bahagian = med_bahagian::where('id_bahagian',$id)->first();

        if ($med_bahagian)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_bahagian
            ],201);
        }
    }

    public function showGet($kod_kementerian, $kod_agensi)  {
        // $id = $request->input('id_bahagian');
        $condition = $kod_agensi . "-" . $kod_kementerian;
        $med_bahagian = med_bahagian::where('kod_bahagian','LIKE', "{$condition}%")->get();
        // dd($condition);

        if ($med_bahagian)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_bahagian
            ],201);
        }
    }

    public function list()  {
        $med_bahagian = med_bahagian::select("*") -> 
                        where('med_bahagian.statusrekod','1') -> get(); // list all data

        if ($med_bahagian)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_bahagian
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_bahagian');
        $nama_bahagian = $request->input('nama_bahagian');
        $updated_by = $request->input('updated_by');

        $med_bahagian = med_bahagian::find($id); 

        $med_bahagian -> update([
            'nama_bahagian' => $nama_bahagian,
            'updated_by' => $updated_by
        ]);

        if ($med_bahagian)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_bahagian
            ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>"Kemaskini Gagal!",
                'data'=>''
            ],404);
        }
    }

    public function delete(Request $request)    {
        $id = $request->input('id_bahagian');

        $med_bahagian = med_bahagian::find($id); 
        
        $med_bahagian -> update([
            'statusrekod' => '0',
        ]);

        if ($med_bahagian)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_bahagian
            ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>"Gagal Padam!",
                'data'=>''
            ],404);
        }
    }
}
