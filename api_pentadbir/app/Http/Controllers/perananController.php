<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\peranan;

class perananController extends Controller
{
    public function register(Request $request) {
        $nama_peranan = $request->input('nama_peranan');
        $FK_submodul = $request->input('FK_submodul');
        $FK_capaian = $request->input('FK_capaian');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');
        $statusrekod = "1";

        // $json_FK_capaian = json_encode($FK_capaian);
        // $arrayFK_capaian = json_decode($json_FK_capaian, true);
        // dd($json_FK_capaian);

        $checkexist = peranan::where('peranan.nama_peranan',$nama_peranan) -> 
                                        get(); // list all data
        if ($checkexist -> count() == 0)   {
            $register = peranan::create([
                'nama_peranan' => $nama_peranan,
                'FK_submodul' => $FK_submodul,
                'FK_capaian' => $FK_capaian,
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

        $peranan = peranan::where('id',$id)->first();

        if ($peranan)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$peranan
            ],201);
        }
    }

    public function list()  {
        $peranan = peranan::where('peranan.statusrekod','1') -> get(); // list all data

        if ($peranan)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$peranan
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_peranan = $request->input('nama_peranan');
        $FK_submodul = $request->input('FK_submodul');
        $FK_capaian = $request->input('FK_capaian');
        $updated_by = $request->input('updated_by');

        $peranan = peranan::find($id); 

        $peranan -> update([
            'nama_peranan' => $nama_peranan,
            'FK_submodul' => $FK_submodul,
            'FK_capaian' => $FK_capaian,
            'updated_by' => $updated_by
        ]);

        if ($peranan)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $peranan
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

        $peranan = peranan::find($id); 
        
        $peranan -> update([
            'statusrekod' => '0',
        ]);

        if ($peranan)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $peranan
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
