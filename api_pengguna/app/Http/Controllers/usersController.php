<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\users;

class usersController extends Controller
{
    public function register(Request $request) {
        $nama = $request->input('nama');
        $emel = $request->input('emel');
        $no_kad_pengenalan = $request->input('no_kad_pengenalan');
        $katalaluan = $request->input('katalaluan');
        $notel = $request->input('notel');
        $tarikh_lahir = $request->input('tarikh_lahir');
        $FK_jenis_pengguna = $request->input('FK_jenis_pengguna');
        $FK_gelaran = $request->input('FK_gelaran');
        $FK_negara_lahir = $request->input('FK_negara_lahir');
        $FK_negeri_lahir = $request->input('FK_negeri_lahir');
        $FK_jantina = $request->input('FK_jantina');
        $FK_warganegara = $request->input('FK_warganegara');
        $FK_bangsa = $request->input('FK_bangsa');
        $FK_etnik = $request->input('FK_etnik');
        $FK_agama = $request->input('FK_agama');

        $salt = "RMY7nZ3+s8xpU1n0O*0o_EGfdoYtd|iU_AzhKCMoSu_xhh-e|~y8FOG*-xLZ";
        $enc_katalaluan     = hash("sha256", $katalaluan.$salt);

        $register = users::create([
            'nama' => $nama,
            'emel' => $emel,
            'no_kad_pengenalan' => $no_kad_pengenalan,
            'katalaluan' => $enc_katalaluan,
            'notel' => $notel,
            'tarikh_lahir' => $tarikh_lahir,
            'FK_jenis_pengguna' => $FK_jenis_pengguna,
            'FK_gelaran' => $FK_gelaran,
            'FK_negara_lahir' => $FK_negara_lahir,
            'FK_negeri_lahir' => $FK_negeri_lahir,
            'FK_jantina' => $FK_jantina,
            'FK_warganegara' => $FK_warganegara,
            'FK_bangsa' => $FK_bangsa,
            'FK_etnik' => $FK_etnik,
            'FK_agama' => $FK_agama,
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
        $no_kad_pengenalan = $request->input('no_kad_pengenalan');

        $users = users::where('no_kad_pengenalan',$no_kad_pengenalan)->first();

        if ($users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$users
            ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>"No Data!",
                'data'=>''
            ]);
        }
    }

    public function list()  {
        $users = users::join('jenispenggunas', 'jenispenggunas.id', '=', 'users.FK_jenis_pengguna') -> 
                        join('gelarans', 'gelarans.id', '=', 'users.FK_gelaran') -> 
                        join('negaras', 'negaras.id', '=', 'users.FK_negara_lahir') -> 
                        join('negeris', 'negeris.id', '=', 'users.FK_negeri_lahir') -> 
                        join('jantinas', 'jantinas.id', '=', 'users.FK_jantina') -> 
                        join('warganegaras', 'warganegaras.id', '=', 'users.FK_warganegara') -> 
                        join('bangsas', 'bangsas.id', '=', 'users.FK_bangsa') -> 
                        join('etniks', 'etniks.id', '=', 'users.FK_bangsa') -> 
                        join('agamas', 'agamas.id', '=', 'users.FK_agama') -> get();

        if ($users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$users
            ],200);
        }
        
    }

    public function listKerajaan()  {
        $users = users::join('jenispenggunas', 'jenispenggunas.id', '=', 'users.FK_jenis_pengguna') -> 
                        join('gelarans', 'gelarans.id', '=', 'users.FK_gelaran') -> 
                        join('negaras', 'negaras.id', '=', 'users.FK_negara_lahir') -> 
                        join('negeris', 'negeris.id', '=', 'users.FK_negeri_lahir') -> 
                        join('jantinas', 'jantinas.id', '=', 'users.FK_jantina') -> 
                        join('warganegaras', 'warganegaras.id', '=', 'users.FK_warganegara') -> 
                        join('bangsas', 'bangsas.id', '=', 'users.FK_bangsa') -> 
                        join('etniks', 'etniks.id', '=', 'users.FK_bangsa') -> 
                        join('agamas', 'agamas.id', '=', 'users.FK_agama') -> 
                        where('FK_jenis_pengguna','1') ->
                        get();

        if ($users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$users
            ],200);
        }
        
    }

    public function listKerajaanSingle($FK_users)  {
        $users = users::select("*", "users.id AS PK") -> 
                        join('jenispenggunas', 'jenispenggunas.id', '=', 'users.FK_jenis_pengguna') -> 
                        join('maklumatkecemasans', 'maklumatkecemasans.FK_users', '=', 'users.id') -> 
                        where('FK_jenis_pengguna','1') -> where('users.id',$FK_users) ->
                        get();

        if ($users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$users
            ],200);
        }
        
    }

    public function listSwasta()  {
        $users = users::join('jenispenggunas', 'jenispenggunas.id', '=', 'users.FK_jenis_pengguna') -> 
                        join('gelarans', 'gelarans.id', '=', 'users.FK_gelaran') -> 
                        join('negaras', 'negaras.id', '=', 'users.FK_negara_lahir') -> 
                        join('negeris', 'negeris.id', '=', 'users.FK_negeri_lahir') -> 
                        join('jantinas', 'jantinas.id', '=', 'users.FK_jantina') -> 
                        join('warganegaras', 'warganegaras.id', '=', 'users.FK_warganegara') -> 
                        join('bangsas', 'bangsas.id', '=', 'users.FK_bangsa') -> 
                        join('etniks', 'etniks.id', '=', 'users.FK_bangsa') -> 
                        join('agamas', 'agamas.id', '=', 'users.FK_agama') -> 
                        where('FK_jenis_pengguna','2') ->
                        get();

        if ($users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$users
            ],200);
        }
        
    }

    public function listPelajar()  {
        $users = users::join('jenispenggunas', 'jenispenggunas.id', '=', 'users.FK_jenis_pengguna') -> 
                        join('gelarans', 'gelarans.id', '=', 'users.FK_gelaran') -> 
                        join('negaras', 'negaras.id', '=', 'users.FK_negara_lahir') -> 
                        join('negeris', 'negeris.id', '=', 'users.FK_negeri_lahir') -> 
                        join('jantinas', 'jantinas.id', '=', 'users.FK_jantina') -> 
                        join('warganegaras', 'warganegaras.id', '=', 'users.FK_warganegara') -> 
                        join('bangsas', 'bangsas.id', '=', 'users.FK_bangsa') -> 
                        join('etniks', 'etniks.id', '=', 'users.FK_bangsa') -> 
                        join('agamas', 'agamas.id', '=', 'users.FK_agama') -> 
                        where('FK_jenis_pengguna','3') ->
                        get();

        if ($users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$users
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama = $request->input('nama');
        $emel = $request->input('emel');
        $no_kad_pengenalan = $request->input('no_kad_pengenalan');
        $notel = $request->input('notel');
        $tarikh_lahir = $request->input('tarikh_lahir');
        $FK_jenis_pengguna = $request->input('FK_jenis_pengguna');
        $FK_gelaran = $request->input('FK_gelaran');
        $FK_negara_lahir = $request->input('FK_negara_lahir');
        $FK_negeri_lahir = $request->input('FK_negeri_lahir');
        $FK_jantina = $request->input('FK_jantina');
        $FK_warganegara = $request->input('FK_warganegara');
        $FK_bangsa = $request->input('FK_bangsa');
        $FK_etnik = $request->input('FK_etnik');
        $FK_agama = $request->input('FK_agama');
        $updated_by = $request->input('updated_by');

        $users = users::find($id); 

        $users -> update([
            'nama' => $nama,
            'emel' => $emel,
            'no_kad_pengenalan' => $no_kad_pengenalan,
            'notel' => $notel,
            'tarikh_lahir' => $tarikh_lahir,
            'FK_jenis_pengguna' => $FK_jenis_pengguna,
            'FK_gelaran' => $FK_gelaran,
            'FK_negara_lahir' => $FK_negara_lahir,
            'FK_negeri_lahir' => $FK_negeri_lahir,
            'FK_jantina' => $FK_jantina,
            'FK_warganegara' => $FK_warganegara,
            'FK_bangsa' => $FK_bangsa,
            'FK_etnik' => $FK_etnik,
            'FK_agama' => $FK_agama,
            'updated_by' => $updated_by
        ]);

        if ($users)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $users
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

    public function delete(Request $request)    {
        $id = $request->input('id');

        $users = users::find($id); 
        
        $users -> update([
            'statusrekod' => '0',
        ]);

        if ($users)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $users
            ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>"Gagal Padam!",
                'data'=>''
            ],404);
        }
    }
}
