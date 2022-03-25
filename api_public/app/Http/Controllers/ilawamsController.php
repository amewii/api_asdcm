<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\ilawams;

class ilawamsController extends Controller
{
    public function register(Request $request) {
        $nama_ila = $request->input('nama_ila');
        $kod_ila = $request->input('kod_ila');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');
        $statusrekod = $request->input('statusrekod');

        $register = ilawams::create([
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
        $id = $request->input('id');

        $ilawams = ilawams::where('id',$id)->first();

        if ($ilawams)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$ilawams
            ],201);
        }
    }

    public function showGet($kod_bahagian)  {
        // $id = $request->input('id');
        $condition = $kod_bahagian;
        $ilawams = ilawams::where('kod_ila','LIKE', "{$condition}%")->get();

        if ($ilawams)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$ilawams
            ],201);
        }
    }

    public function list()  {
        $ilawams = ilawams::select("*", "ilawams.id AS PK") -> 
                        where('ilawams.statusrekod','1') -> get(); // list all data

        if ($ilawams)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$ilawams
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_ila = $request->input('nama_ila');
        $updated_by = $request->input('updated_by');

        $ilawams = ilawams::find($id); 

        $ilawams -> update([
            'nama_ila' => $nama_ila,
            'updated_by' => $updated_by
        ]);

        if ($ilawams)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $ilawams
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

        $ilawams = ilawams::find($id); 
        
        $ilawams -> update([
            'statusrekod' => '0',
        ]);

        if ($ilawams)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $ilawams
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
