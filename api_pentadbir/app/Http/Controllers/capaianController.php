<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\capaian;

class capaianController extends Controller
{
    public function register(Request $request) {
        $FK_peranan = $request->input('FK_peranan');
        $FK_users = $request->input('FK_users');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');
        $statusrekod = "1";

        $checkexist = capaian::where('capaian.FK_peranan',$FK_peranan) -> where('capaian.FK_users',$FK_users) -> 
                                        get(); // list all data
        if ($checkexist -> count() == 0)   {
            $register = capaian::create([
                'FK_peranan' => $FK_peranan,
                'FK_users' => $FK_users,
                'created_by' => $created_by,
                'updated_by' => $updated_by,
                'statusrekod' => $statusrekod
            ]);
        } else  {
            return response()->json([
                'success'=>'false',
                'message'=>'Data Exist',
                'data'=>$checkexist
            ],405);
        }        

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
                'message'=>'Register Failed',
                'data'=>$register
            ],406);
        }
    }

    public function show(Request $request)  {
        $id = $request->input('id');

        $capaian = capaian::where('id',$id)->first();

        if ($capaian)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$capaian
            ],201);
        }
    }

    public function showGet($FK_users)  {
        // $id = $request->input('id');

        $capaian = capaian::select("*", "capaian.id AS PK", "capaian.statusrekod AS capaianstatusrekod") ->
                            join('peranan', 'peranan.id', '=', 'capaian.FK_peranan') -> 
                            where('FK_users',$FK_users)->first();

        if ($capaian)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$capaian
            ],201);
        }
    }

    public function list()  {
        $capaian = capaian::select("*", "capaian.id AS PK", "capaian.statusrekod AS capaianstatusrekod") ->
                            join('users', 'users.id', '=', 'capaian.FK_users') -> 
                            join('peranan', 'peranan.id', '=', 'capaian.FK_peranan') -> 
                            where('capaian.statusrekod','1') -> get(); // list all data

        if ($capaian)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$capaian
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $FK_peranan = $request->input('FK_peranan');
        $FK_users = $request->input('FK_users');
        $updated_by = $request->input('updated_by');

        $capaian = capaian::find($id); 

        $capaian -> update([
            'FK_peranan' => $FK_peranan,
            'FK_users' => $FK_users,
            'updated_by' => $updated_by
        ]);

        if ($capaian)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $capaian
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

        $capaian = capaian::find($id); 
        
        $capaian -> update([
            'statusrekod' => '0',
        ]);

        if ($capaian)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $capaian
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
