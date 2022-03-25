<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\userswastas;

class userswastasController extends Controller
{
    public function register(Request $request) {
        $FK_users = $request->input('FK_users');
        $FK_kategori_pengguna = $request->input('FK_kategori_pengguna');
        $jawatan = $request->input('jawatan');
        $alamat1_rumah = $request->input('alamat1_rumah');
        $alamat2_rumah = $request->input('alamat2_rumah');
        $poskod_rumah = $request->input('poskod_rumah');
        $daerah_rumah = $request->input('daerah_rumah');
        $negeri_rumah = $request->input('negeri_rumah');
        $negara_rumah = $request->input('negara_rumah');
        $organisasi = $request->input('organisasi');
        $alamat1_organisasi = $request->input('alamat1_organisasi');
        $alamat2_organisasi = $request->input('alamat2_organisasi');
        $poskod_organisasi = $request->input('poskod_organisasi');
        $daerah_organisasi = $request->input('daerah_organisasi');
        $negeri_organisasi = $request->input('negeri_organisasi');
        $negara_organisasi = $request->input('negara_organisasi');
        $nama_majikan = $request->input('nama_majikan');
        $notel_majikan = $request->input('notel_majikan');
        $emel_majikan = $request->input('emel_majikan');
        $statusrekod = $request->input('statusrekod');

        $register = userswastas::create([
            'FK_users' => $FK_users,
            'FK_kategori_pengguna' => $FK_kategori_pengguna,
            'jawatan' => $jawatan,
            'alamat1_rumah' => $alamat1_rumah,
            'alamat2_rumah' => $alamat2_rumah,
            'poskod_rumah' => $poskod_rumah,
            'daerah_rumah' => $daerah_rumah,
            'negeri_rumah' => $negeri_rumah,
            'negara_rumah' => $negara_rumah,
            'organisasi' => $organisasi,
            'alamat1_organisasi' => $alamat1_organisasi,
            'alamat2_organisasi' => $alamat2_organisasi,
            'poskod_organisasi' => $poskod_organisasi,
            'daerah_organisasi' => $daerah_organisasi,
            'negeri_organisasi' => $negeri_organisasi,
            'negara_organisasi' => $negara_organisasi,
            'nama_majikan' => $nama_majikan,
            'notel_majikan' => $notel_majikan,
            'emel_majikan' => $emel_majikan,
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

        $userswastas = userswastas::where('id',$id)->first();

        if ($userswastas)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$userswastas
            ],200);
        }
    }

    public function list()  {
        $userswastas = userswastas::all();

        if ($userswastas)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$userswastas
            ],200);
        }
        
    }
}
