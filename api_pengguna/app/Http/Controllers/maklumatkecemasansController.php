<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\maklumatkecemasans;

class maklumatkecemasansController extends Controller
{
    public function register(Request $request) {
        $FK_users = $request->input('FK_users');
        $nama_mk = $request->input('nama_mk');
        $notel_mk = $request->input('notel_mk');
        $status_rekod = $request->input('status_rekod');

        $register = maklumatkecemasans::create([
            'FK_users' => $FK_users,
            'nama_mk' => $nama_mk,
            'notel_mk' => $notel_mk,
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

        $maklumatkecemasans = maklumatkecemasans::where('id',$id)->first();

        if ($maklumatkecemasans)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$maklumatkecemasans
            ],200);
        }
    }

    public function list()  {
        $maklumatkecemasans = maklumatkecemasans::all();

        if ($maklumatkecemasans)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$maklumatkecemasans
            ],200);
        }
        
    }
}
