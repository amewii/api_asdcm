<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\jantinas;

class jantinasController extends Controller
{
    public function register(Request $request) {
        $nama_jantina = $request->input('nama_jantina');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $register = jantinas::create([
            'nama_jantina' => $nama_jantina,
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
                'message'=>'Register Failed!',
                'data'=>$register
            ],405);
        }
    }

    public function show(Request $request)  {
        $id = $request->input('id');

        $jantinas = jantinas::where('id',$id)->first();

        if ($jantinas)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$jantinas
            ],201);
        }
    }

    public function list()  {
        $jantinas = jantinas::where('statusrekod','1') -> get(); // list all data

        if ($jantinas)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$jantinas
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_jantina = $request->input('nama_jantina');
        $updated_by = $request->input('updated_by');

        $jantinas = jantinas::find($id); 

        $jantinas -> update([
            'nama_jantina' => $nama_jantina,
            'updated_by' => $updated_by
        ]);

        if ($jantinas)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $jantinas
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

        $jantinas = jantinas::find($id); 

        $jantinas -> delete();

        if ($jantinas)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $jantinas
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
