<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\pentadbirs;

class pentadbirsController extends Controller
{
    public function register(Request $request) {
        $FK_users = $request->input('FK_users');
        $FK_capaian = $request->input('FK_capaian');
        $FK_kampus = $request->input('FK_kampus');
        $FK_kluster = $request->input('FK_kluster');
        $FK_unit = $request->input('FK_unit');

        $register = pentadbirs::create([
            'FK_users' => $FK_users,
            'FK_capaian' => $FK_capaian,
            'FK_kampus' => $FK_kampus,
            'FK_kluster' => $FK_kluster,
            'FK_unit' => $FK_unit,
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

        $pentadbirs = pentadbirs::where('id',$id)->first();

        if ($pentadbirs)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$pentadbirs
            ],200);
        }
    }

    public function list()  {
        $pentadbirs = pentadbirs::all();

        if ($pentadbirs)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$pentadbirs
            ],200);
        }
        
    }
}
