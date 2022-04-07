<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_usersgov;

class med_usersgovController extends Controller
{
    public function register(Request $request) {
        $FK_users = $request->input('FK_users');
        $emel_kerajaan = $request->input('emel_kerajaan');
        $notel_kerajaan = $request->input('notel_kerajaan');
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
        $users_intan = $request->input('users_intan');
        $FK_kampus = $request->input('FK_kampus');
        $FK_kluster = $request->input('FK_kluster');
        $FK_subkluster = $request->input('FK_subkluster');
        $FK_unit = $request->input('FK_unit');
        $FK_kementerian = $request->input('FK_kementerian');
        $FK_agensi = $request->input('FK_agensi');
        $FK_bahagian = $request->input('FK_bahagian');
        $FK_ila = $request->input('FK_ila');
        $alamat1_pejabat = $request->input('alamat1_pejabat');
        $alamat2_pejabat = $request->input('alamat2_pejabat');
        $poskod_pejabat = $request->input('poskod_pejabat');
        $daerah_pejabat = $request->input('daerah_pejabat');
        $negeri_pejabat = $request->input('negeri_pejabat');
        $statusrekod = $request->input('statusrekod');

        $register = med_usersgov::create([
            'FK_users' => $FK_users,
            'emel_kerajaan' => $emel_kerajaan,
            'notel_kerajaan' => $notel_kerajaan,
            'kod_jawatan' => $kod_jawatan,
            'nama_jawatan' => $nama_jawatan,
            'kategori_perkhidmatan' => $kategori_perkhidmatan,
            'skim' => $skim,
            'taraf_jawatan' => $taraf_jawatan,
            'jenis_perkhidmatan' => $jenis_perkhidmatan,
            'tarikh_lantikan' => $tarikh_lantikan,
            'users_intan' => $users_intan,
            'FK_kampus' => $FK_kampus,
            'FK_kluster' => $FK_kluster,
            'FK_subkluster' => $FK_subkluster,
            'FK_unit' => $FK_unit,
            'FK_kementerian' => $FK_kementerian,
            'FK_agensi' => $FK_agensi,
            'FK_bahagian' => $FK_bahagian,
            'FK_ila' => $FK_ila,
            'alamat1_pejabat' => $alamat1_pejabat,
            'alamat2_pejabat' => $alamat2_pejabat,
            'poskod_pejabat' => $poskod_pejabat,
            'daerah_pejabat' => $daerah_pejabat,
            'negeri_pejabat' => $negeri_pejabat,
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
        $id = $request->input('id_usersgov');

        $med_usersgov = med_usersgov::where('id_usersgov',$id)->first();

        if ($med_usersgov)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_usersgov
            ],200);
        }
    }

    public function list()  {
        $med_usersgov = med_usersgov::all();

        if ($med_usersgov)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_usersgov
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_usersgov');
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

        $med_usersgov = med_usersgov::find($id); 

        $med_usersgov -> update([
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

        if ($med_usersgov)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_usersgov
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
