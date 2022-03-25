<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\agamas;

class agamasController extends Controller
{
    public function register(Request $request) {
        $nama_agama = $request->input('nama_agama');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $agamas = agamas::where('nama_agama',$nama_agama)->first();

        if ($agamas)   {
            return response()->json([
                'success'=>false,
                'message'=>'Gagal!',
                'data'=>'Maklumat telah didaftarkan'
            ],201);
        } else {        
            $register = agamas::create([
                'nama_agama' => $nama_agama,
                'created_by' => $created_by,
                'updated_by' => $updated_by
            ]);
    
            if ($register)  {
                return response()->json([
                    'success'=>'true',
                    'message'=>'Berjaya!',
                    'data'=>'Maklumat berjaya didaftarkan'
                ],201);
            }
    
            else    {
                return response()->json([
                    'success'=>'false',
                    'message'=>'Gagal Daftar Maklumat',
                    'data'=>$register
                ],405);
            }
        }
    }

    public function show(Request $request)  {
        $id = $request->input('id');

        $agamas = agamas::where('id',$id)->first();

        if ($agamas)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$agamas
            ],201);
        }
    }

    public function list()  {
        $agamas = agamas::where('statusrekod','1') -> get(); // list all data // list all data

        if ($agamas)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$agamas
            ],200);
        }
        
    }

    public function listall()  {
        $agamas = agamas::get(); // list all data // list all data

        if ($agamas)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$agamas
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_agama = $request->input('nama_agama');
        $updated_by = $request->input('updated_by');

        $agamas = agamas::where('nama_agama',$nama_agama)->first();

        if ($agamas)   {
            return response()->json([
                'success'=>false,
                'message'=>'Gagal!',
                'data'=>'Maklumat telah didaftarkan'
            ],201);
        } else {        
            $agamas = agamas::find($id); 

            $agamas -> update([
                'nama_agama' => $nama_agama,
                'updated_by' => $updated_by
            ]);

            if ($agamas)  {
                return response()->json([
                    'success'=>true,
                    'message'=>"Kemaskini Berjaya!",
                    'data' => $agamas
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
        
        $agamas = agamas::find($id); 
        
        switch($agamas->statusrekod)    {
            case 0: $agamas -> update([
                        'statusrekod' => '1',
                    ]);
                    break;
            case 1: $agamas -> update([
                        'statusrekod' => '0',
                    ]);
                    break;
        }

        if ($agamas)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $agamas
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
