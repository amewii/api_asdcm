<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\usersgovs;

class usersgovsController extends Controller
{
    public function register(Request $request) {
        $FK_users = $request->input('FK_users');
        // $FK_kategori_pengguna = $request->input('FK_kategori_pengguna');
        $kod_jawatan = $request->input('kod_jawatan');
        $nama_jawatan = $request->input('nama_jawatan');
        $kategori_perkhidmatan = $request->input('kategori_perkhidmatan');
        $skim = $request->input('skim');
        // $unit_organisasi = $request->input('unit_organisasi');
        $gred = $request->input('gred');
        $taraf_jawatan = $request->input('taraf_jawatan');
        $jenis_perkhidmatan = $request->input('jenis_perkhidmatan');
        $tarikh_lantikan = $request->input('tarikh_lantikan');
        $statusrekod = $request->input('statusrekod');

        $register = usersgovs::create([
            'FK_users' => $FK_users,
            'kod_jawatan' => $kod_jawatan,
            'nama_jawatan' => $nama_jawatan,
            'kategori_perkhidmatan' => $kategori_perkhidmatan,
            'skim' => $skim,
            'taraf_jawatan' => $taraf_jawatan,
            'jenis_perkhidmatan' => $jenis_perkhidmatan,
            'tarikh_lantikan' => $tarikh_lantikan,
            'gred' => $gred,
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

        $usersgovs = usersgovs::where('id',$id)->first();

        if ($usersgovs)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$usersgovs
            ],200);
        }
    }

    public function list()  {
        $usersgovs = usersgovs::all();

        if ($usersgovs)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$usersgovs
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $FK_users = $request->input('FK_users');
        $FK_kategori_pengguna = $request->input('FK_kategori_pengguna');
        $kod_jawatan = $request->input('kod_jawatan');
        $nama_jawatan = $request->input('nama_jawatan');
        $kategori_perkhidmatan = $request->input('kategori_perkhidmatan');
        $skim = $request->input('skim');
        $unit_organisasi = $request->input('unit_organisasi');
        $gred = $request->input('gred');
        $taraf_jawatan = $request->input('taraf_jawatan');
        $jenis_perkhidmatan = $request->input('jenis_perkhidmatan');
        $tarikh_lantikan = $request->input('tarikh_lantikan');
        $updated_by = $request->input('updated_by');

        $usersgovs = usersgovs::find($id); 

        $usersgovs -> update([
            'FK_users' => $FK_users,
            'FK_kategori_pengguna' => $FK_kategori_pengguna,
            'kod_jawatan' => $kod_jawatan,
            'nama_jawatan' => $nama_jawatan,
            'kategori_perkhidmatan' => $kategori_perkhidmatan,
            'skim' => $skim,
            'taraf_jawatan' => $taraf_jawatan,
            'jenis_perkhidmatan' => $jenis_perkhidmatan,
            'tarikh_lantikan' => $tarikh_lantikan,
            'unit_organisasi' => $unit_organisasi,
            'gred' => $gred,
            'updated_by' => $updated_by
        ]);

        if ($usersgovs)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $usersgovs
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
}
