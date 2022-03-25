<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\user_admins;

class user_adminsController extends Controller
{
    public function register(Request $request) {
        $FK_kampus = $request->input('FK_kampus');
        $FK_kluster = $request->input('FK_kluster');
        $FK_unit = $request->input('FK_unit');
        $FK_modul = $request->input('FK_modul');
        $FK_users = $request->input('FK_users');
        $kategori = $request->input('kategori');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $user_admins = user_admins::where('FK_kampus',$FK_kampus)->
                                    where('FK_kluster',$FK_kluster)->
                                    where('FK_unit',$FK_unit)->
                                    where('FK_modul',$FK_modul)->
                                    where('statusrekod','1')->
                                    first();
        
        if ($user_admins)   {
            return response()->json([
                'success'=>false,
                'message'=>'Pendaftaran Gagal!',
                'data'=>'Pegawai telah berdaftar di bawah modul ini'
            ],201);
        } else  {
            $register = user_admins::create([
                'FK_kampus' => $FK_kampus,
                'FK_kluster' => $FK_kluster,
                'FK_unit' => $FK_unit,
                'FK_modul' => $FK_modul,
                'FK_users' => $FK_users,
                'kategori' => $kategori,
                'created_by' => $created_by,
                'updated_by' => $updated_by
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
                    'message'=>'Register Failed',
                    'data'=>$register
                ],405);
            }
        }        
    }

    public function show(Request $request)  {
        $id = $request->input('id');

        $user_admins = user_admins::where('id',$id)->first();

        if ($user_admins)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$user_admins
            ],201);
        }
    }

    public function showGet(Request $request, $id)  {
        // $id = $request->input('id');

        $user_admins = user_admins::where('id',$id)->first();

        if ($user_admins)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$user_admins
            ],201);
        }
    }

    public function showModul(Request $request, $FK_users)  {
        // $FK_users = $request->input('FK_users');

        $user_admins = user_admins::select("*", "user_admins.id AS PK") -> 
                                    join('moduls', 'moduls.id', '=', 'user_admins.FK_modul') -> 
                                    where('user_admins.FK_users',$FK_users) -> 
                                    get();

        if ($user_admins)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$user_admins
            ],201);
        }
    }

    public function showUserModul($FK_users, $FK_modul)  {
        // $FK_users = $request->input('FK_users');

        $user_admins = user_admins::select("*", "user_admins.id AS PK") -> 
                                    join('moduls', 'moduls.id', '=', 'user_admins.FK_modul') -> 
                                    where('user_admins.FK_users',$FK_users) -> 
                                    where('user_admins.FK_modul',$FK_modul) -> 
                                    first();

        if ($user_admins)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$user_admins
            ],201);
        }
    }

    public function list()  {
        $user_admins = user_admins::select("*", "user_admins.id AS PK") -> 
                                    join('kampuses', 'kampuses.id', '=', 'user_admins.FK_kampus') -> 
                                    join('negeris', 'negeris.id', '=', 'kampuses.FK_negeri') -> 
                                    join('klusters', 'klusters.id', '=', 'user_admins.FK_kluster') -> 
                                    join('units', 'units.id', '=', 'user_admins.FK_unit') -> 
                                    join('moduls', 'moduls.id', '=', 'user_admins.FK_modul') -> 
                                    join('users', 'users.id', '=', 'user_admins.FK_users') -> 
                                    where('user_admins.statusrekod','1') -> where('kampuses.statusrekod','1') -> where('klusters.statusrekod','1') -> where('units.statusrekod','1') -> where('moduls.statusrekod','1') -> where('users.statusrekod','1') -> 
                                    get(); // list all data

        if ($user_admins)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$user_admins
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $FK_kampus = $request->input('FK_kampus');
        $FK_kluster = $request->input('FK_kluster');
        $FK_unit = $request->input('FK_unit');
        $FK_modul = $request->input('FK_modul');
        $FK_users = $request->input('FK_users');
        $kategori = $request->input('kategori');
        $updated_by = $request->input('updated_by');


        $user_admins = user_admins::find($id); 

        $user_admins -> update([
            'FK_kampus' => $FK_kampus,
            'FK_kluster' => $FK_kluster,
            'FK_unit' => $FK_unit,
            'FK_modul' => $FK_modul,
            'FK_users' => $FK_users,
            'kategori' => $kategori,
            'updated_by' => $updated_by
        ]);

        if ($user_admins)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $user_admins
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

        $user_admins = user_admins::find($id); 
        
        $user_admins -> update([
            'statusrekod' => '0',
        ]);

        if ($user_admins)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $user_admins
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
