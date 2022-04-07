<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_kementerian;

class med_kementerianController extends Controller
{
    public function register(Request $request) {
        $nama_kementerian = $request->input('nama_kementerian');
        $kod_kementerian = $request->input('kod_kementerian');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');
        $statusrekod = $request->input('statusrekod');

        $register = med_kementerian::create([
            'nama_kementerian' => $nama_kementerian,
            'kod_kementerian' => $kod_kementerian,
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
        $id = $request->input('id_kementerian');

        $med_kementerian = med_kementerian::where('id_kementerian',$id)->first();

        if ($med_kementerian)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_kementerian
            ],201);
        }
    }

    public function list()  {
        $med_kementerian = med_kementerian::where('med_kementerian.statusrekod','1') -> get(); // list all data

        if ($med_kementerian)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_kementerian
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_kementerian');
        $nama_kementerian = $request->input('nama_kementerian');
        $kod_kementerian = $request->input('kod_kementerian');
        $updated_by = $request->input('updated_by');

        $med_kementerian = med_kementerian::find($id); 

        $med_kementerian -> update([
            'nama_kementerian' => $nama_kementerian,
            'kod_kementerian' => $kod_kementerian,
            'updated_by' => $updated_by
        ]);

        if ($med_kementerian)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_kementerian
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
        $id = $request->input('id_kementerian');

        $med_kementerian = med_kementerian::find($id); 
        
        $med_kementerian -> update([
            'statusrekod' => '0',
        ]);

        if ($med_kementerian)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_kementerian
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
