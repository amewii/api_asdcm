<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_gred;

class med_gredController extends Controller
{
    public function register(Request $request) {
        $nama_gred = $request->input('nama_gred');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');
        $statusrekod = $request->input('statusrekod');

        $register = med_gred::create([
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
        $id = $request->input('id_gred');

        $med_gred = med_gred::where('id_gred',$id)->first();

        if ($med_gred)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_gred
            ],200);
        }
    }

    public function list()  {
        $med_gred = med_gred::where('statusrekod','1') -> get();

        if ($med_gred)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_gred
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_gred');
        $nama_gred = $request->input('nama_gred');
        $updated_by = $request->input('updated_by');

        $med_gred = med_gred::find($id); 

        $med_gred -> update([
            'nama_gred' => $nama_gred,
            'updated_by' => $updated_by
        ]);

        if ($med_gred)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_gred
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
        $id = $request->input('id_gred');

        $med_gred = med_gred::find($id); 

        $med_gred -> update([
            'statusrekod' => '0',
        ]);

        if ($med_gred)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_gred
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
