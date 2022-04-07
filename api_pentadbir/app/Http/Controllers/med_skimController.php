<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_skim;

class med_skimController extends Controller
{
    public function register(Request $request) {
        $kod_skim = $request->input('kod_skim');
        $nama_skim = $request->input('nama_skim');
        $created_by = $request->input('created_by'); // Pakai IC
        $updated_by = $request->input('updated_by'); // Pakai IC
        $statusrekod = $request->input('statusrekod');

        $register = med_skim::create([
            'kod_skim' => $kod_skim,
            'nama_skim' => $nama_skim,
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
        $id = $request->input('id_skim');

        $med_skim = med_skim::where('id_skim',$id)->first();

        if ($med_skim)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_skim
            ],200);
        }
    }

    public function list()  {
        $med_skim = med_skim::where('statusrekod','1') -> get();

        if ($med_skim)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_skim
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_skim');
        $kod_skim = $request->input('kod_skim');
        $nama_skim = $request->input('nama_skim');
        $updated_by = $request->input('updated_by');

        $med_skim = med_skim::find($id); 

        $med_skim -> update([
            'kod_skim' => $kod_skim,
            'nama_skim' => $nama_skim,
            'updated_by' => $updated_by
        ]);

        if ($med_skim)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_skim
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
        $id = $request->input('id_skim');

        $med_skim = med_skim::find($id); 

        $med_skim -> update([
            'statusrekod' => '0',
        ]);

        if ($med_skim)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_skim
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
