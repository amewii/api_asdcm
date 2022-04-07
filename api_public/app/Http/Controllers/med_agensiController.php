<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_agensi;

class med_agensiController extends Controller
{
    public function register(Request $request) {
        $nama_agensi = $request->input('nama_agensi');
        $kod_agensi = $request->input('kod_agensi');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');
        $statusrekod = $request->input('statusrekod');

        $register = med_agensi::create([
            'nama_agensi' => $nama_agensi,
            'kod_agensi' => $kod_agensi,
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
                'message'=>'Tak Jadi Boss',
                'data'=>$register
            ],405);
        }
    }

    public function show(Request $request)  {
        $id = $request->input('id_agensi');

        $med_agensi = med_agensi::where('id_agensi',$id)->where('statusrekod','1')->first();

        if ($med_agensi)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_agensi
            ],201);
        }
    }

    public function list()  {
        $med_agensi = med_agensi::where('med_agensi.statusrekod','1') -> get(); // list all data

        if ($med_agensi)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_agensi
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_agensi');
        $nama_agensi = $request->input('nama_agensi');
        $kod_agensi = $request->input('kod_agensi');
        $updated_by = $request->input('updated_by');

        $med_agensi = med_agensi::find($id); 

        $med_agensi -> update([
            'nama_agensi' => $nama_agensi,
            'kod_agensi' => $kod_agensi,
            'updated_by' => $updated_by
        ]);

        if ($med_agensi)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_agensi
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
        $id = $request->input('id_agensi');

        $med_agensi = med_agensi::find($id); 
        
        $med_agensi -> update([
            'statusrekod' => '0',
        ]);

        if ($med_agensi)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_agensi
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
