<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\sub_moduls;

class sub_modulsController extends Controller
{
    public function register(Request $request) {
        $FK_modul = $request->input('FK_modul');
        $nama_submodul = $request->input('nama_submodul');
        $nama_menu_submodul = $request->input('nama_menu_submodul');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $register = sub_moduls::create([
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

        $sub_moduls = sub_moduls::get();

        $q = $sub_moduls->where('FK_modul',$FK_modul);

        if ($sub_moduls)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$q
            ],201);
        }
    }

    public function showSubmodul(Request $request, $FK_modul)  {

        $sub_moduls = sub_moduls::get();

        $q = $sub_moduls->where('FK_modul',$FK_modul);

        if ($sub_moduls)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$q
            ],201);
        }
    }

    public function list()  {
        $sub_moduls = sub_moduls::select("submoduls.id", "nama_submodul", "FK_modul", "nama_modul", "submoduls.statusrekod", "moduls.statusrekod") -> 
                                    join('moduls', 'moduls.id', '=', 'sub_moduls.FK_modul') -> 
                                    where('submoduls.statusrekod','1') -> where('moduls.statusrekod','1') -> get(); // list all data

        if ($sub_moduls)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$sub_moduls
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_submodul = $request->input('nama_submodul');
        $nama_menu_submodul = $request->input('nama_menu_submodul');
        $updated_by = $request->input('updated_by');

        $sub_moduls = sub_moduls::find($id); 

        $sub_moduls -> update([
            'nama_submodul' => $nama_submodul,
            'nama_menu_submodul' => $nama_menu_submodul,
            'updated_by' => $updated_by
        ]);

        if ($sub_moduls)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $sub_moduls
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

        $sub_moduls = sub_moduls::find($id); 

        $sub_moduls -> update([
            'statusrekod' => '0',
        ]);

        if ($sub_moduls)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $sub_moduls
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
