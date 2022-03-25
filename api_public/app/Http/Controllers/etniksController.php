<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\etniks;

class etniksController extends Controller
{
    public function register(Request $request) {
        $nama_etnik = $request->input('nama_etnik');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $etniks = etniks::where('nama_etnik',$nama_etnik)->first();

        if ($etniks)   {
            return response()->json([
                'success'=>false,
                'message'=>'Gagal!',
                'data'=>'Maklumat telah didaftarkan'
            ],201);
        } else  {
            $register = etniks::create([
                'nama_etnik' => $nama_etnik,
                'created_by' => $created_by,
                'updated_by' => $updated_by
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
                ],405);
            }
        }        
    }

    public function show(Request $request)  {
        $id = $request->input('id');

        $etniks = etniks::where('id',$id)->first();

        if ($etniks)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$etniks
            ],201);
        }
    }

    public function list()  {
        $etniks = etniks::where('statusrekod','1') -> get(); // list all data

        if ($etniks)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$etniks
            ],200);
        }
        
    }

    public function listall()  {
        $etniks = etniks::get(); // list all data

        if ($etniks)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$etniks
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_etnik = $request->input('nama_etnik');
        $updated_by = $request->input('updated_by');

        $etniks = etniks::where('nama_etnik',$nama_etnik)->first();

        if ($etniks)   {
            return response()->json([
                'success'=>false,
                'message'=>'Gagal!',
                'data'=>'Maklumat telah didaftarkan'
            ],201);
        } else  {
            $etniks = etniks::find($id); 

            $etniks -> update([
                'nama_etnik' => $nama_etnik,
                'updated_by' => $updated_by
            ]);

            if ($etniks)  {
                return response()->json([
                    'success'=>true,
                    'message'=>"Kemaskini Berjaya!",
                    'data' => $etniks
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
    }

    public function delete(Request $request)    {
        $id = $request->input('id');

        $etniks = etniks::find($id); 

        switch($etniks->statusrekod)    {
            case 0: $etniks -> update([
                        'statusrekod' => '1',
                    ]);
                    break;
            case 1: $etniks -> update([
                        'statusrekod' => '0',
                    ]);
                    break;
        }

        if ($etniks)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $etniks
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
