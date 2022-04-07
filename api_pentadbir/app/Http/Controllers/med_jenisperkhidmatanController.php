<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_jenisperkhidmatan;

class med_jenisperkhidmatanController extends Controller
{
    public function register(Request $request) {
        $nama_jenisperkhidmatan = $request->input('nama_jenisperkhidmatan');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');
        $statusrekod = $request->input('statusrekod');

        $register = med_jenisperkhidmatan::create([
            'nama_jenisperkhidmatan' => $nama_jenisperkhidmatan,
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
        $id = $request->input('id_jenisperkhidmatan');

        $med_jenisperkhidmatan = med_jenisperkhidmatan::where('id_jenisperkhidmatan',$id)->first();

        if ($med_jenisperkhidmatan)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_jenisperkhidmatan
            ],200);
        }
    }

    public function list()  {
        $med_jenisperkhidmatan = med_jenisperkhidmatan::where('statusrekod','1') -> get();

        if ($med_jenisperkhidmatan)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_jenisperkhidmatan
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_jenisperkhidmatan');
        $nama_jenisperkhidmatan = $request->input('nama_jenisperkhidmatan');
        $updated_by = $request->input('updated_by');

        $med_jenisperkhidmatan = med_jenisperkhidmatan::find($id); 

        $med_jenisperkhidmatan -> update([
            'nama_jenisperkhidmatan' => $nama_jenisperkhidmatan,
            'updated_by' => $updated_by
        ]);

        if ($med_jenisperkhidmatan)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_jenisperkhidmatan
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
        $id = $request->input('id_jenisperkhidmatan');

        $med_jenisperkhidmatan = med_jenisperkhidmatan::find($id); 

        $med_jenisperkhidmatan -> update([
            'statusrekod' => '0',
        ]);

        if ($med_jenisperkhidmatan)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_jenisperkhidmatan
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
