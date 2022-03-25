<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\jenispenggunas;

class jenispenggunasController extends Controller
{
    public function register(Request $request) {
        $jenis_pengguna = $request->input('jenis_pengguna');
        $kod_jenis_pengguna = $request->input('kod_jenis_pengguna');

        $register = jenispenggunas::create([
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
        $id = $request->input('id');

        $jenispenggunas = jenispenggunas::where('id',$id)->first();

        if ($jenispenggunas)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$jenispenggunas
            ],200);
        }
    }

    public function list()  {
        $jenispenggunas = jenispenggunas::all();

        if ($jenispenggunas)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$jenispenggunas
            ],200);
        }
        
    }
}
