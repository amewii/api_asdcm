<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_submodul;

class med_submodulController extends Controller
{
    public function register(Request $request) {
        $FK_modul = $request->input('FK_modul');
        $nama_submodul = $request->input('nama_submodul');
        $nama_menu_submodul = $request->input('nama_menu_submodul');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $register = med_submodul::create([
            'FK_modul' => $FK_modul,
            'nama_submodul' => $nama_submodul,
            'nama_menu_submodul' => $nama_menu_submodul,
            'created_by' => $created_by,
            'updated_by' => $updated_by
        ]);

        if ($register)  {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$register
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

    public function show(Request $request)  {
        $FK_modul = $request->input('FK_modul');

        $med_submodul = med_submodul::get();

        $q = $med_submodul->where('FK_modul',$FK_modul);

        if ($med_submodul)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$q
            ],201);
        }
    }

    public function showSubmodul(Request $request, $FK_modul)  {

        $med_submodul = med_submodul::get();

        $q = $med_submodul->where('FK_modul',$FK_modul);

        if ($med_submodul)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$q
            ],201);
        }
    }

    public function list()  {
        $med_submodul = med_submodul::select("med_submodul.id_submodul", "nama_submodul", "FK_modul", "nama_modul", "med_submodul.statusrekod", "med_modul.statusrekod") -> 
                                    join('med_modul', 'med_modul.id_modul', '=', 'med_submodul.FK_modul') -> 
                                    where('med_submodul.statusrekod','1') -> where('med_modul.statusrekod','1') -> get(); // list all data

        if ($med_submodul)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_submodul
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_submodul');
        $nama_submodul = $request->input('nama_submodul');
        $nama_menu_submodul = $request->input('nama_menu_submodul');
        $updated_by = $request->input('updated_by');

        $med_submodul = med_submodul::find($id); 

        $med_submodul -> update([
            'nama_submodul' => $nama_submodul,
            'nama_menu_submodul' => $nama_menu_submodul,
            'updated_by' => $updated_by
        ]);

        if ($med_submodul)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_submodul
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
        $id = $request->input('id_submodul');

        $med_submodul = med_submodul::find($id); 

        $med_submodul -> update([
            'statusrekod' => '0',
        ]);

        if ($med_submodul)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_submodul
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
