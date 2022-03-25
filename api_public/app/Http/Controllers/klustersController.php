<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\klusters;

class klustersController extends Controller
{
    public function register(Request $request) {
        $nama_kluster = $request->input('nama_kluster');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $register = klusters::create([
            'nama_kluster' => $nama_kluster,
            'created_by' => $created_by,
            'updated_by' => $updated_by
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
        $id = $request->input('id');

        $klusters = klusters::where('id',$id)->first();

        if ($klusters)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$klusters
            ],201);
        }
    }

    public function list()  {
        $klusters = klusters::where('statusrekod','1') -> get(); // list all data

        if ($klusters)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$klusters
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_kluster = $request->input('nama_kluster');
        $updated_by = $request->input('updated_by');

        $klusters = klusters::find($id); 

        $klusters -> update([
            'nama_kluster' => $nama_kluster,
            'updated_by' => $updated_by
        ]);

        if ($klusters)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $klusters
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
        $id = $request->input('id');

        $klusters = klusters::find($id); 

        $klusters -> update([
            'statusrekod' => '0',
        ]);

        if ($klusters)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $klusters
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
