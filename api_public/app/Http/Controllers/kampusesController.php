<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\kampuses;

class kampusesController extends Controller
{
    public function register(Request $request) {
        $nama_kampus = $request->input('nama_kampus');
        $alamat = $request->input('alamat');
        $bandar = $request->input('bandar');
        $poskod = $request->input('poskod');
        $FK_negeri = $request->input('FK_negeri');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $kampuses = kampuses::where('nama_kampus',$nama_kampus)->first();

        if ($kampuses)   {
            return response()->json([
                'success'=>false,
                'message'=>'Gagal!',
                'data'=>'Maklumat telah didaftarkan'
            ],201);
        } else {        
            $register = kampuses::create([
                'nama_kampus' => $nama_kampus,
                'alamat' => $alamat,
                'bandar' => $bandar,
                'poskod' => $poskod,
                'FK_negeri' => $FK_negeri,
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
        $id = $request->input('id');

        $kampuses = kampuses::where('id',$id)->first();

        if ($kampuses)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$kampuses
            ],201);
        }
    }

    public function list()  {
        $kampuses = kampuses::select("*", "kampuses.id AS PK", "kampuses.statusrekod AS kampusstatusrekod") -> 
                    join('negeris', 'negeris.id', '=', 'kampuses.FK_negeri') -> 
                    where('kampuses.statusrekod','1') -> where('negeris.statusrekod','1') -> 
                    get(); // list all data

        if ($kampuses)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$kampuses
            ],200);
        }
        
    }

    public function listall()  {
        $kampuses = kampuses::select("*", "kampuses.id AS PK", "kampuses.statusrekod AS kampusstatusrekod") -> 
                    join('negeris', 'negeris.id', '=', 'kampuses.FK_negeri') -> 
                    get(); // list all data

        if ($kampuses)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$kampuses
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_kampus = $request->input('nama_kampus');
        $alamat = $request->input('alamat');
        $poskod = $request->input('poskod');
        $bandar = $request->input('bandar');
        $FK_negeri = $request->input('FK_negeri');
        $updated_by = $request->input('updated_by');

        $kampuses = kampuses::where('nama_kampus',$nama_kampus)->first();

        if ($kampuses)   {
            return response()->json([
                'success'=>false,
                'message'=>'Gagal!',
                'data'=>'Maklumat telah didaftarkan'
            ],201);
        } else {        
            $kampuses = kampuses::find($id); 

            $kampuses -> update([
                'nama_kampus' => $nama_kampus,
                'alamat' => $alamat,
                'bandar' => $bandar,
                'poskod' => $poskod,
                'FK_negeri' => $FK_negeri,
                'updated_by' => $updated_by
            ]);

            if ($kampuses)  {
                return response()->json([
                    'success'=>true,
                    'message'=>"Kemaskini Berjaya!",
                    'data' => $kampuses
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

        $kampuses = kampuses::find($id);

        switch($kampuses->statusrekod)    {
            case 0: $kampuses -> update([
                        'statusrekod' => '1',
                    ]);
                    break;
            case 1: $kampuses -> update([
                        'statusrekod' => '0',
                    ]);
                    break;
        }

        if ($kampuses)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $kampuses
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
