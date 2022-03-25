<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\kementerians;

class kementeriansController extends Controller
{
    public function register(Request $request) {
        $nama_kementerian = $request->input('nama_kementerian');
        $kod_kementerian = $request->input('kod_kementerian');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');
        $statusrekod = $request->input('statusrekod');

        $register = kementerians::create([
            'nama_kementerian' => $nama_kementerian,
            'kod_kementerian' => $kod_kementerian,
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

        $kementerians = kementerians::where('id',$id)->first();

        if ($kementerians)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$kementerians
            ],201);
        }
    }

    public function list()  {
        $kementerians = kementerians::select("*", "kementerians.id AS PK") -> 
                        where('kementerians.statusrekod','1') -> get(); // list all data

        if ($kementerians)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$kementerians
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_kementerian = $request->input('nama_kementerian');
        $kod_kementerian = $request->input('kod_kementerian');
        $updated_by = $request->input('updated_by');

        $kementerians = kementerians::find($id); 

        $kementerians -> update([
            'nama_kementerian' => $nama_kementerian,
            'kod_kementerian' => $kod_kementerian,
            'updated_by' => $updated_by
        ]);

        if ($kementerians)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $kementerians
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

        $kementerians = kementerians::find($id); 
        
        $kementerians -> update([
            'statusrekod' => '0',
        ]);

        if ($kementerians)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $kementerians
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
