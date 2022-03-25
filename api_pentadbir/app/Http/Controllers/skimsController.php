<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\skims;

class skimsController extends Controller
{
    public function register(Request $request) {
        $kod_skims = $request->input('kod_skims');
        $nama_skims = $request->input('nama_skims');
        $created_by = $request->input('created_by'); // Pakai IC
        $updated_by = $request->input('updated_by'); // Pakai IC
        $statusrekod = $request->input('statusrekod');

        $register = skims::create([
            'kod_skims' => $kod_skims,
            'nama_skims' => $nama_skims,
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

        $skims = skims::where('id',$id)->first();

        if ($skims)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$skims
            ],200);
        }
    }

    public function list()  {
        $skims = skims::where('statusrekod','1') -> get();

        if ($skims)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$skims
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $kod_skims = $request->input('kod_skims');
        $nama_skims = $request->input('nama_skims');
        $updated_by = $request->input('updated_by');

        $skims = skims::find($id); 

        $skims -> update([
            'kod_skims' => $kod_skims,
            'nama_skims' => $nama_skims,
            'updated_by' => $updated_by
        ]);

        if ($skims)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $skims
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

        $skims = skims::find($id); 

        $skims -> update([
            'statusrekod' => '0',
        ]);

        if ($skims)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $skims
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
