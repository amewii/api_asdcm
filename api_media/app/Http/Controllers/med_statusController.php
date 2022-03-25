<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_status;

class med_statusController extends Controller
{
    public function register(Request $request) {
        $kod_status = $request->input('kod_status');
        $nama_status = $request->input('nama_status');
        $created_by = $request->input('created_by'); // Pakai IC
        $updated_by = $request->input('updated_by'); // Pakai IC
        $statusrekod = $request->input('statusrekod');

        $register = med_status::create([
            'kod_status' => $kod_status,
            'nama_status' => $nama_status,
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

        $med_status = med_status::where('id',$id)->first();

        if ($med_status)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_status
            ],200);
        }
    }

    public function list()  {
        $med_status = med_status::where('statusrekod','1') -> get();

        if ($med_status)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_status
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $kod_status = $request->input('kod_status');
        $nama_status = $request->input('nama_status');
        $updated_by = $request->input('updated_by');

        $med_status = med_status::find($id); 

        $med_status -> update([
            'kod_status' => $kod_status,
            'nama_status' => $nama_status,
            'updated_by' => $updated_by
        ]);

        if ($med_status)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_status
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

        $med_status = med_status::find($id); 

        $med_status -> update([
            'statusrekod' => '0',
        ]);

        if ($med_status)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_status
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
