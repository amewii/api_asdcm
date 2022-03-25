<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\bangsas;

class bangsasController extends Controller
{
    public function register(Request $request) {
        $nama_bangsa = $request->input('nama_bangsa');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $register = bangsas::create([
            'nama_bangsa' => $nama_bangsa,
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

        $bangsas = bangsas::where('id',$id)->first();

        if ($bangsas)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$bangsas
            ],201);
        }
    }

    public function list()  {
        $bangsas = bangsas::where('statusrekod','1') -> get(); // list all data

        if ($bangsas)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$bangsas
            ],200);
        }
        
    }

    public function listall()  {
        $bangsas = bangsas::get(); // list all data

        if ($bangsas)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$bangsas
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_bangsa = $request->input('nama_bangsa');
        $updated_by = $request->input('updated_by');

        $bangsas = bangsas::find($id); 

        $bangsas -> update([
            'nama_bangsa' => $nama_bangsa,
            'updated_by' => $updated_by
        ]);

        if ($bangsas)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $bangsas
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

        $bangsas = bangsas::find($id); 

        switch($bangsas->statusrekod)    {
            case 0: $bangsas -> update([
                        'statusrekod' => '1',
                    ]);
                    break;
            case 1: $bangsas -> update([
                        'statusrekod' => '0',
                    ]);
                    break;
        }

        if ($bangsas)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $bangsas
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
