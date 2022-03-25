<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\tarafjawatans;

class tarafjawatansController extends Controller
{
    public function register(Request $request) {
        $nama_tarafjawatan = $request->input('nama_tarafjawatan');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');
        $statusrekod = $request->input('statusrekod');

        $register = tarafjawatans::create([
            'nama_tarafjawatan' => $nama_tarafjawatan,
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
                'message'=>'Bad Request',
                'data'=>$register
            ],400);
        }
    }

    public function show(Request $request)  {
        $id = $request->input('id');

        $tarafjawatans = tarafjawatans::where('id',$id)->first();

        if ($tarafjawatans)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$tarafjawatans
            ],200);
        }
    }

    public function list()  {
        $tarafjawatans = tarafjawatans::where('statusrekod','1') -> get();

        if ($tarafjawatans)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$tarafjawatans
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_tarafjawatan = $request->input('nama_tarafjawatan');
        $updated_by = $request->input('updated_by');

        $tarafjawatans = tarafjawatans::find($id); 

        $tarafjawatans -> update([
            'nama_tarafjawatan' => $nama_tarafjawatan,
            'updated_by' => $updated_by
        ]);

        if ($tarafjawatans)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $tarafjawatans
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

        $tarafjawatans = tarafjawatans::find($id); 

        $tarafjawatans -> update([
            'statusrekod' => '0',
        ]);

        if ($tarafjawatans)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $tarafjawatans
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
