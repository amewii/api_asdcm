<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_kampus;

class med_kampusController extends Controller
{
    public function register(Request $request) {
        $nama_kampus = $request->input('nama_kampus');
        $alamat = $request->input('alamat');
        $bandar = $request->input('bandar');
        $poskod = $request->input('poskod');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $med_kampus = med_kampus::where('nama_kampus',$nama_kampus)->first();

        if ($med_kampus)   {
            return response()->json([
                'success'=>false,
                'message'=>'Gagal!',
                'data'=>'Maklumat telah didaftarkan'
            ],201);
        } else {        
            $register = med_kampus::create([
                'nama_kampus' => $nama_kampus,
                'alamat' => $alamat,
                'bandar' => $bandar,
                'poskod' => $poskod,
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
                    'message'=>'Tak Jadi Boss',
                    'data'=>$register
                ],405);
            }
        }
    }

    public function show(Request $request)  {
        $id = $request->input('id_kampus');

        $med_kampus = med_kampus::where('id_kampus',$id)->first();

        if ($med_kampus)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_kampus
            ],201);
        }
    }

    public function list()  {
        $med_kampus = med_kampus::where('med_kampus.statusrekod','1') -> get(); // list all data

        if ($med_kampus)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_kampus
            ],200);
        }
        
    }

    public function listall()  {
        $med_kampus = med_kampus::get(); // list all data

        if ($med_kampus)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_kampus
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_kampus');
        $nama_kampus = $request->input('nama_kampus');
        $alamat = $request->input('alamat');
        $poskod = $request->input('poskod');
        $bandar = $request->input('bandar');
        $updated_by = $request->input('updated_by');

        $med_kampus = med_kampus::where('nama_kampus',$nama_kampus)->first();

        if ($med_kampus)   {
            return response()->json([
                'success'=>false,
                'message'=>'Gagal!',
                'data'=>'Maklumat telah didaftarkan'
            ],201);
        } else {        
            $med_kampus = med_kampus::find($id); 

            $med_kampus -> update([
                'nama_kampus' => $nama_kampus,
                'alamat' => $alamat,
                'bandar' => $bandar,
                'poskod' => $poskod,
                'updated_by' => $updated_by
            ]);

            if ($med_kampus)  {
                return response()->json([
                    'success'=>true,
                    'message'=>"Kemaskini Berjaya!",
                    'data' => $med_kampus
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
        $id = $request->input('id_kampus');

        $med_kampus = med_kampus::find($id);

        switch($med_kampus->statusrekod)    {
            case 0: $med_kampus -> update([
                        'statusrekod' => '1',
                    ]);
                    break;
            case 1: $med_kampus -> update([
                        'statusrekod' => '0',
                    ]);
                    break;
        }

        if ($med_kampus)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_kampus
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
