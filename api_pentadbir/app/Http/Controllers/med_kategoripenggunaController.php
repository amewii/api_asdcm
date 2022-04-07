<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_kategoripengguna;

class med_kategoripenggunaController extends Controller
{
    public function register(Request $request) {
        $FK_jenis_pengguna = $request->input('FK_jenis_pengguna');
        $kategori_pengguna = $request->input('kategori_pengguna');
        $kod_kategori_pengguna = $request->input('kod_kategori_pengguna');

        $register = med_kategoripengguna::create([
            'FK_jenis_pengguna' => $FK_jenis_pengguna,
            'kategori_pengguna' => $kategori_pengguna,
            'kod_kategori_pengguna' => $kod_kategori_pengguna,
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
                'message'=>'Bad Request',
                'data'=>$register
            ],400);
        }
    }

    public function show(Request $request)  {
        $id = $request->input('id_kategoripengguna');

        $med_kategoripengguna = med_kategoripengguna::where('id_kategoripengguna',$id)->first();

        if ($med_kategoripengguna)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_kategoripengguna
            ],200);
        }
    }

    public function list()  {
        $med_kategoripengguna = med_kategoripengguna::all();

        if ($med_kategoripengguna)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_kategoripengguna
            ],200);
        }
        
    }
}
