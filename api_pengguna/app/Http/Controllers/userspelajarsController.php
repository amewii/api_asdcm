<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\userspelajars;

class userspelajarsController extends Controller
{
    public function register(Request $request) {
        $FK_users = $request->input('FK_users');
        $FK_kategori_pengguna = $request->input('FK_kategori_pengguna');
        $alamat1_rumah = $request->input('alamat1_rumah');
        $alamat2_rumah = $request->input('alamat2_rumah');
        $poskod_rumah = $request->input('poskod_rumah');
        $daerah_rumah = $request->input('daerah_rumah');
        $negeri_rumah = $request->input('negeri_rumah');
        $negara_rumah = $request->input('negara_rumah');
        $nama_sekolah = $request->input('nama_sekolah');
        $alamat1_sekolah = $request->input('alamat1_sekolah');
        $alamat2_sekolah = $request->input('alamat2_sekolah');
        $poskod_sekolah = $request->input('poskod_sekolah');
        $daerah_sekolah = $request->input('daerah_sekolah');
        $negeri_sekolah = $request->input('negeri_sekolah');
        $statusrekod = $request->input('statusrekod');

        $register = userspelajars::create([
            'FK_users' => $FK_users,
            'FK_kategori_pengguna' => $FK_kategori_pengguna,
            'alamat1_rumah' => $alamat1_rumah,
            'alamat2_rumah' => $alamat2_rumah,
            'poskod_rumah' => $poskod_rumah,
            'daerah_rumah' => $daerah_rumah,
            'negeri_rumah' => $negeri_rumah,
            'negara_rumah' => $negara_rumah,
            'nama_sekolah' => $nama_sekolah,
            'alamat1_sekolah' => $alamat1_sekolah,
            'alamat2_sekolah' => $alamat2_sekolah,
            'poskod_sekolah' => $poskod_sekolah,
            'daerah_sekolah' => $daerah_sekolah,
            'negeri_sekolah' => $negeri_sekolah,
            'statusrekod' => $statusrekod,
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

        $userspelajars = userspelajars::where('id',$id)->first();

        if ($userspelajars)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$userspelajars
            ],200);
        }
    }

    public function list()  {
        $userspelajars = userspelajars::all();

        if ($userspelajars)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$userspelajars
            ],200);
        }
        
    }
}
