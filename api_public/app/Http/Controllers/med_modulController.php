<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_modul;

class med_modulController extends Controller
{
    public function register(Request $request) {
        $kod_modul = $request->input('kod_modul');
        $nama_modul = $request->input('nama_modul');
        $nama_menu_modul = $request->input('nama_menu_modul');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $register = med_modul::create([
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
        $id = $request->input('id_modul');

        $med_modul = med_modul::where('id_modul',$id)->first();

        if ($med_modul)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_modul
            ],201);
        }
    }

    public function list()  {
        $med_modul = med_modul::where('statusrekod','1') -> get(); // list all data

        if ($med_modul)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_modul
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_modul');
        $kod_modul = $request->input('kod_modul');
        $nama_modul = $request->input('nama_modul');
        $nama_menu_modul = $request->input('nama_menu_modul');
        $updated_by = $request->input('updated_by');

        $med_modul = med_modul::find($id); 

        $med_modul -> update([
            'kod_modul' => $kod_modul,
            'nama_modul' => $nama_modul,
            'nama_menu_modul' => $nama_menu_modul,
            'updated_by' => $updated_by
        ]);

        if ($med_modul)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_modul
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
        $id = $request->input('id_modul');

        $med_modul = med_modul::find($id); 

        $med_modul -> delete();

        if ($med_modul)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_modul
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
