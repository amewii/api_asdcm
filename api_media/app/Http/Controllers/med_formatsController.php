<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_formats;

class med_formatsController extends Controller
{
    public function register(Request $request) {
        $kod_format = $request->input('kod_format');
        $created_by = $request->input('created_by'); // Pakai IC
        $updated_by = $request->input('updated_by'); // Pakai IC
        $statusrekod = $request->input('statusrekod');

        $register = med_formats::create([
            'kod_format' => $kod_format,
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

        $med_formats = med_formats::where('id',$id)->first();

        if ($med_formats)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_formats
            ],200);
        }
    }

    public function list()  {
        $med_formats = med_formats::where('med_formats.statusrekod','1') -> get();

        if ($med_formats)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_formats
            ],200);
        }
        
    }

    public function listall()  {
        $med_formats = med_formats::get();

        if ($med_formats)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_formats
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $kod_format = $request->input('kod_format');
        $updated_by = $request->input('updated_by'); // Pakai IC

        $med_formats = med_formats::find($id); 

        $med_formats -> update([
            'kod_format' => $kod_format,
            'updated_by' => $updated_by
        ]);

        if ($med_formats)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_formats
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

        $med_formats = med_formats::find($id); 

        switch($med_formats->statusrekod)    {
            case 0: $med_formats -> update([
                        'statusrekod' => '1',
                    ]);
                    break;
            case 1: $med_formats -> update([
                        'statusrekod' => '0',
                    ]);
                    break;
        }

        if ($med_formats)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_formats
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
