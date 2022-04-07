<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_jenispengguna;

class med_jenispenggunaController extends Controller
{
    public function register(Request $request) {
        $jenis_pengguna = $request->input('jenis_pengguna');
        $kod_jenis_pengguna = $request->input('kod_jenis_pengguna');

        $register = med_jenispengguna::create([
            'jenis_pengguna' => $jenis_pengguna,
            'kod_jenis_pengguna' => $kod_jenis_pengguna,
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
        $id = $request->input('id_jenispengguna');

        $med_jenispengguna = med_jenispengguna::where('id_jenispengguna',$id)->first();

        if ($med_jenispengguna)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_jenispengguna
            ],200);
        }
    }

    public function list()  {
        $med_jenispengguna = med_jenispengguna::get();

        if ($med_jenispengguna)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_jenispengguna
            ],200);
        }
        
    }
}
