<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\bahagians;

class bahagiansController extends Controller
{
    public function register(Request $request) {
        $nama_bahagian = $request->input('nama_bahagian');
        $kod_bahagian = $request->input('kod_bahagian');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');
        $statusrekod = $request->input('statusrekod');

        $register = bahagians::create([
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
        $id = $request->input('id');

        $bahagians = bahagians::where('id',$id)->first();

        if ($bahagians)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$bahagians
            ],201);
        }
    }

    public function showGet($kod_kementerian, $kod_agensi)  {
        // $id = $request->input('id');
        $condition = $kod_agensi . "-" . $kod_kementerian;
        $bahagians = bahagians::where('kod_bahagian','LIKE', "{$condition}%")->get();
        // dd($condition);

        if ($bahagians)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$bahagians
            ],201);
        }
    }

    public function list()  {
        $bahagians = bahagians::select("*", "bahagians.id AS PK") -> 
                        where('bahagians.statusrekod','1') -> get(); // list all data

        if ($bahagians)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$bahagians
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_bahagian = $request->input('nama_bahagian');
        $updated_by = $request->input('updated_by');

        $bahagians = bahagians::find($id); 

        $bahagians -> update([
            'nama_bahagian' => $nama_bahagian,
            'updated_by' => $updated_by
        ]);

        if ($bahagians)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $bahagians
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

        $bahagians = bahagians::find($id); 
        
        $bahagians -> update([
            'statusrekod' => '0',
        ]);

        if ($bahagians)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $bahagians
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
