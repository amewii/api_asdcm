<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\warganegaras;

class warganegarasController extends Controller
{
    public function register(Request $request) {
        $nama_warganegara = $request->input('nama_warganegara');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $register = warganegaras::create([
            'nama_warganegara' => $nama_warganegara,
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

        $warganegaras = warganegaras::where('id',$id)->first();

        if ($warganegaras)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$warganegaras
            ],201);
        }
    }

    public function list()  {
        $warganegaras = warganegaras::where('statusrekod','1') -> get(); // list all data

        if ($warganegaras)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$warganegaras
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_warganegara = $request->input('nama_warganegara');
        $updated_by = $request->input('updated_by');

        $warganegaras = warganegaras::find($id); 

        $warganegaras -> update([
            'nama_warganegara' => $nama_warganegara,
            'updated_by' => $updated_by
        ]);

        if ($warganegaras)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $warganegaras
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

        $warganegaras = warganegaras::where('id',$id) -> update([
            'statusrekod' => '0',
        ]);

        if ($warganegaras)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $warganegaras
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
