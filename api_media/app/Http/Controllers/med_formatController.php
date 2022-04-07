<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_format;
use PDO;

class med_formatController extends Controller
{
    public function register(Request $request) {
        $kod_format = $request->input('kod_format');
        $jenis_format = $request->input('jenis_format');
        $created_by = $request->input('created_by'); // Pakai IC
        $updated_by = $request->input('updated_by'); // Pakai IC
        $statusrekod = $request->input('statusrekod');

        $register = med_format::create([
            'kod_format' => $kod_format,
            'jenis_format' => $jenis_format,
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
        $id = $request->input('id_format');

        $med_format = med_format::where('id_format',$id)->first();

        if ($med_format)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_format
            ],200);
        }
    }

    public function list()  {
        $med_format = med_format::where('med_format.statusrekod','1') -> get();

        if ($med_format)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_format
            ],200);
        }
        
    }

    public function listall()  {
        $med_format = med_format::get();

        if ($med_format)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_format
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_format');
        $kod_format = $request->input('kod_format');
        $jenis_format = $request->input('jenis_format');
        $updated_by = $request->input('updated_by'); // Pakai IC

        $med_format_search = med_format::where('kod_format',$kod_format) -> first(); 

        if ($med_format_search) {            
            return response()->json([
                'success'=>false,
                'message'=>"Gagal! Data Telah Wujud",
                'data'=>''
            ],200);
        } else  {
            $med_format = med_format::where('id_format', $id) -> update([
                'kod_format' => $kod_format,
                'jenis_format' => $jenis_format,
                'updated_by' => $updated_by
            ]);
    
            if ($med_format)  {
                return response()->json([
                    'success'=>true,
                    'message'=>"Kemaskini Berjaya!",
                    'data' => $med_format
                ],200);
            }
            else{
                return response()->json([
                    'success'=>false,
                    'message'=>"Kemaskini Gagal!",
                    'data'=>''
                ],200);
            }
        }
    }

    public function delete(Request $request)    {
        $id = $request->input('id_format');

        $med_format_search = med_format::where('id_format',$id) -> first(); 

        switch($med_format_search->statusrekod)    {
            case 0: $med_format = med_format::where('id_format', $id) -> update([
                        'statusrekod' => '1',
                    ]);
                    break;
            case 1: $med_format = med_format::where('id_format', $id) -> update([
                        'statusrekod' => '0',
                    ]);
                    break;
        }

        $med_format_search = med_format::where('id_format',$id) -> first(); 

        if ($med_format)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Ubah!",
                'data' => $med_format_search
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
