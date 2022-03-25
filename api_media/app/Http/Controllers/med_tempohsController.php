<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_tempohs;

class med_tempohsController extends Controller
{
    public function register(Request $request) {
        $tempoh = $request->input('tempoh');
        $created_by = $request->input('created_by'); // Pakai IC
        $updated_by = $request->input('updated_by'); // Pakai IC
        $statusrekod = $request->input('statusrekod');

        $register = med_tempohs::create([
            'tempoh' => $tempoh,
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
                'message'=>'Register Failed!',
                'data'=>$register
            ],400);
        }
    }

    public function show(Request $request)  {
        $id = $request->input('id');

        $med_tempohs = med_tempohs::where('id',$id)->first();

        if ($med_tempohs)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_tempohs
            ],200);
        }
    }

    public function showGet(Request $request, $id)  {
        // $id = $request->input('id');

        $med_tempohs = med_tempohs::where('id',$id)->first();

        if ($med_tempohs)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_tempohs
            ],200);
        }
    }

    public function list()  {
        $med_tempohs = med_tempohs::where('statusrekod','1') -> get();

        if ($med_tempohs)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_tempohs
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $tempoh = $request->input('tempoh');
        $updated_by = $request->input('updated_by');

        $med_tempohs = med_tempohs::find($id); 

        $med_tempohs -> update([
            'tempoh' => $tempoh,
            'updated_by' => $updated_by
        ]);

        if ($med_tempohs)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_tempohs
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

        $med_tempohs = med_tempohs::find($id); 

        $med_tempohs -> update([
            'statusrekod' => '0',
        ]);

        if ($med_tempohs)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_tempohs
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
