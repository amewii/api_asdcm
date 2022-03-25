<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\negaras;

class negarasController extends Controller
{
    public function register(Request $request) {
        $nama_negara = $request->input('nama_negara');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $register = negaras::create([
            'nama_negara' => $nama_negara,
            'statusrekod' => '1',
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

        $negaras = negaras::where('id',$id)->first();

        if ($negaras)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$negaras
            ],201);
        }
    }

    public function list()  {
        $negaras = negaras::where('statusrekod','1') -> get(); // list all data

        if ($negaras)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$negaras
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_negara = $request->input('nama_negara');
        $updated_by = $request->input('updated_by');

        $negaras = negaras::find($id); 

        $negaras -> update([
            'nama_negara' => $nama_negara,
            'updated_by' => $updated_by
        ]);

        if ($negaras)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $negaras
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

        $negaras = negaras::where('id',$id) -> update([
            'statusrekod' => '0',
        ]);

        if ($negaras)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $negaras
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
