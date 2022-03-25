<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\moduls;

class modulsController extends Controller
{
    public function register(Request $request) {
        $kod_modul = $request->input('kod_modul');
        $nama_modul = $request->input('nama_modul');
        $nama_menu_modul = $request->input('nama_menu_modul');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $register = moduls::create([
            'kod_modul' => $kod_modul,
            'nama_modul' => $nama_modul,
            'nama_menu_modul' => $nama_menu_modul,
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
                'message'=>'Gagal Daftar Maklumat',
                'data'=>$register
            ],405);
        }
    }

    public function show(Request $request)  {
        $id = $request->input('id');

        $moduls = moduls::where('id',$id)->first();

        if ($moduls)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$moduls
            ],201);
        }
    }

    public function list()  {
        $moduls = moduls::where('statusrekod','1') -> get(); // list all data

        if ($moduls)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$moduls
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $kod_modul = $request->input('kod_modul');
        $nama_modul = $request->input('nama_modul');
        $nama_menu_modul = $request->input('nama_menu_modul');
        $updated_by = $request->input('updated_by');

        $moduls = moduls::find($id); 

        $moduls -> update([
            'kod_modul' => $kod_modul,
            'nama_modul' => $nama_modul,
            'nama_menu_modul' => $nama_menu_modul,
            'updated_by' => $updated_by
        ]);

        if ($moduls)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $moduls
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

        $moduls = moduls::find($id); 

        $moduls -> delete();

        if ($moduls)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $moduls
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
