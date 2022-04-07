<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_tarafjawatan;

class med_tarafjawatanController extends Controller
{
    public function register(Request $request) {
        $nama_tarafjawatan = $request->input('nama_tarafjawatan');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');
        $statusrekod = $request->input('statusrekod');

        $register = med_tarafjawatan::create([
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
        $id = $request->input('id_tarafjawatan');

        $med_tarafjawatan = med_tarafjawatan::where('id_tarafjawatan',$id)->first();

        if ($med_tarafjawatan)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_tarafjawatan
            ],200);
        }
    }

    public function list()  {
        $med_tarafjawatan = med_tarafjawatan::where('statusrekod','1') -> get();

        if ($med_tarafjawatan)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_tarafjawatan
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_tarafjawatan');
        $nama_tarafjawatan = $request->input('nama_tarafjawatan');
        $updated_by = $request->input('updated_by');

        $med_tarafjawatan = med_tarafjawatan::find($id); 

        $med_tarafjawatan -> update([
            'nama_tarafjawatan' => $nama_tarafjawatan,
            'updated_by' => $updated_by
        ]);

        if ($med_tarafjawatan)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_tarafjawatan
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
        $id = $request->input('id_tarafjawatan');

        $med_tarafjawatan = med_tarafjawatan::find($id); 

        $med_tarafjawatan -> update([
            'statusrekod' => '0',
        ]);

        if ($med_tarafjawatan)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_tarafjawatan
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
