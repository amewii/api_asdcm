<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\capaians;

class capaiansController extends Controller
{
    public function register(Request $request) {
        $nama_modul = $request->input('nama_modul');
        $capaian = $request->input('capaian');
        $status_capaian = $request->input('status_capaian');
        $status_rekod = $request->input('status_rekod');

        $register = capaians::create([
            'nama_modul' => $nama_modul,
            'capaian' => $capaian,
            'status_capaian' => $status_capaian,
            'status_rekod' => $status_rekod,
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

        $capaians = capaians::where('id',$id)->first();

        if ($capaians)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$capaians
            ],200);
        }
    }

    public function list()  {
        $capaians = capaians::all();

        if ($capaians)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$capaians
            ],200);
        }
        
    }
}
