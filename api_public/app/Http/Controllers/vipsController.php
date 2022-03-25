<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\vips;

class vipsController extends Controller
{
    public function register(Request $request) {
        $nama_vip = $request->input('nama_vip');
        $jawatan_vip = $request->input('jawatan_vip');
        $FK_gelaran = $request->input('FK_gelaran');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $register = vips::create([
            'nama_vip' => $nama_vip,
            'jawatan_vip' => $jawatan_vip,
            'FK_gelaran' => $FK_gelaran,
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

    public function show(Request $request)  {
        $id = $request->input('id');

        $vips = vips::where('id',$id)->first();

        if ($vips)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$vips
            ],201);
        }
    }

    public function list()  {
        $vips = vips::select("*", "vips.id AS PK") -> 
                        join('gelarans', 'gelarans.id', '=', 'vips.FK_gelaran') -> 
                        where('vips.statusrekod','1') -> where('gelarans.statusrekod','1') -> get(); // list all data

        if ($vips)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$vips
            ],200);
        }
        
    }

    public function listall()  {
        $vips = vips::select("*", "vips.id AS PK", "vips.statusrekod AS vipstatusrekod") -> 
                        join('gelarans', 'gelarans.id', '=', 'vips.FK_gelaran') -> 
                        get(); // list all data

        if ($vips)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$vips
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_vip = $request->input('nama_vip');
        $jawatan_vip = $request->input('jawatan_vip');
        $FK_gelaran = $request->input('FK_gelaran');
        $updated_by = $request->input('updated_by');

        $vips = vips::find($id); 

        $vips -> update([
            'nama_vip' => $nama_vip,
            'jawatan_vip' => $jawatan_vip,
            'FK_gelaran' => $FK_gelaran,
            'updated_by' => $updated_by
        ]);

        if ($vips)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $vips
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

        $vips = vips::find($id); 
        
        switch($vips->statusrekod)    {
            case 0: $vips -> update([
                        'statusrekod' => '1',
                    ]);
                    break;
            case 1: $vips -> update([
                        'statusrekod' => '0',
                    ]);
                    break;
        }

        if ($vips)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $vips
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
