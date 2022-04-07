<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_ilawam;

class med_ilawamController extends Controller
{
    public function register(Request $request) {
        $nama_ila = $request->input('nama_ila');
        $kod_ila = $request->input('kod_ila');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');
        $statusrekod = $request->input('statusrekod');

        $register = med_ilawam::create([
            'nama_ila' => $nama_ila,
            'kod_ila' => $kod_ila,
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
        $id = $request->input('id_ilawam');

        $med_ilawam = med_ilawam::where('id_ilawam',$id)->first();

        if ($med_ilawam)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_ilawam
            ],201);
        }
    }

    public function showGet($kod_bahagian)  {
        // $id = $request->input('id_ilawam');
        $condition = $kod_bahagian;
        $med_ilawam = med_ilawam::where('kod_ila','LIKE', "{$condition}%")->get();

        if ($med_ilawam)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_ilawam
            ],201);
        }
    }

    public function list()  {
        $med_ilawam = med_ilawam::where('med_ilawam.statusrekod','1') -> get(); // list all data

        if ($med_ilawam)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_ilawam
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_ilawam');
        $nama_ila = $request->input('nama_ila');
        $updated_by = $request->input('updated_by');

        $med_ilawam = med_ilawam::find($id); 

        $med_ilawam -> update([
            'nama_ila' => $nama_ila,
            'updated_by' => $updated_by
        ]);

        if ($med_ilawam)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_ilawam
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
        $id = $request->input('id_ilawam');

        $med_ilawam = med_ilawam::find($id); 
        
        $med_ilawam -> update([
            'statusrekod' => '0',
        ]);

        if ($med_ilawam)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_ilawam
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
