<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\greds;

class gredsController extends Controller
{
    public function register(Request $request) {
        $nama_gred = $request->input('nama_gred');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');
        $statusrekod = $request->input('statusrekod');

        $register = greds::create([
            'nama_gred' => $nama_gred,
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

        $greds = greds::where('id',$id)->first();

        if ($greds)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$greds
            ],200);
        }
    }

    public function list()  {
        $greds = greds::where('statusrekod','1') -> get();

        if ($greds)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$greds
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_gred = $request->input('nama_gred');
        $updated_by = $request->input('updated_by');

        $greds = greds::find($id); 

        $greds -> update([
            'nama_gred' => $nama_gred,
            'updated_by' => $updated_by
        ]);

        if ($greds)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $greds
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

        $greds = greds::find($id); 

        $greds -> update([
            'statusrekod' => '0',
        ]);

        if ($greds)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $greds
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
