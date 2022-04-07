<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_vip;

class med_vipController extends Controller
{
    public function register(Request $request) {
        $nama_vip = $request->input('nama_vip');
        $jawatan_vip = $request->input('jawatan_vip');
        $FK_gelaran = $request->input('FK_gelaran');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $register = med_vip::create([
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
        $id = $request->input('id_vip');

        $med_vip = med_vip::where('id_vip',$id)->first();

        if ($med_vip)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_vip
            ],201);
        }
    }

    public function list()  {
        $med_vip = med_vip::join('med_gelaran', 'med_gelaran.id_gelaran', '=', 'med_vip.FK_gelaran') -> 
                        where('med_vip.statusrekod','1') -> where('med_gelaran.statusrekod','1') -> get(); // list all data

        if ($med_vip)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_vip
            ],200);
        }
        
    }

    public function listall()  {
        $med_vip = med_vip::select("*", "med_vip.statusrekod AS vipstatusrekod") -> 
                        join('med_gelaran', 'med_gelaran.id_gelaran', '=', 'med_vip.FK_gelaran') -> 
                        get(); // list all data

        if ($med_vip)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_vip
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_vip');
        $nama_vip = $request->input('nama_vip');
        $jawatan_vip = $request->input('jawatan_vip');
        $FK_gelaran = $request->input('FK_gelaran');
        $updated_by = $request->input('updated_by');

        $med_vip_check = med_vip::where('nama_vip',$nama_vip) -> where('jawatan_vip',$jawatan_vip) -> where('FK_gelaran',$FK_gelaran) -> first(); 
        
        if ($med_vip_check) {
            return response()->json([
                'success'=>false,
                'message'=>"Gagal! Data Telah Wujud.",
                'data'=>''
            ],200);
        } else  {
            $med_vip = med_vip::where('id_vip',$id) -> update([
                'nama_vip' => $nama_vip,
                'jawatan_vip' => $jawatan_vip,
                'FK_gelaran' => $FK_gelaran,
                'updated_by' => $updated_by
            ]);
    
            if ($med_vip)  {
                return response()->json([
                    'success'=>true,
                    'message'=>"Kemaskini Berjaya!",
                    'data' => $med_vip
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
        $id = $request->input('id_vip');

        $med_vip_check = med_vip::where('id_vip',$id) -> first(); 
        
        switch($med_vip_check->statusrekod)    {
            case 0: $med_vip = med_vip::where('id_vip',$id) -> update([
                        'statusrekod' => '1',
                    ]);
                    break;
            case 1: $med_vip = med_vip::where('id_vip',$id) -> update([
                        'statusrekod' => '0',
                    ]);
                    break;
        }

        $med_vip_check = med_vip::where('id_vip',$id) -> first(); 

        if ($med_vip)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Ubah!",
                'data' => $med_vip_check
            ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>"Gagal Ubah!",
                'data'=>''
            ],404);
        }
    }
}
