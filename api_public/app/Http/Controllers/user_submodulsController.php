<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\user_submoduls;

class user_submodulsController extends Controller
{
    public function register(Request $request) {
        $FK_users = $request->input('FK_users');
        $FK_useradmin = $request->input('FK_useradmin');
        $FK_submodul = $request->input('FK_submodul');
        $FK_capaian = $request->input('FK_capaian');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');
        $statusrekod = $request->input('statusrekod');

        $checkexist = user_submoduls::where('user_submoduls.FK_users',$FK_users) -> where('user_submoduls.FK_useradmin',$FK_useradmin) -> where('user_submoduls.FK_submodul',$FK_submodul) -> 
                                        get(); // list all data
        if ($checkexist -> count() == 0)   {
            $register = user_submoduls::create([
                'FK_users' => $FK_users,
                'FK_useradmin' => $FK_useradmin,
                'FK_submodul' => $FK_submodul,
                'FK_capaian' => $FK_capaian,
                'created_by' => $created_by,
                'updated_by' => $updated_by,
                'statusrekod' => $statusrekod
            ]);
        } else  {
            return response()->json([
                'success'=>'false',
                'message'=>'Data Exist',
                'data'=>$checkexist
            ],405);
        }        

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
            ],406);
        }
    }

    public function show(Request $request)  {
        $id = $request->input('id');

        $user_submoduls = user_submoduls::where('id',$id)->first();

        if ($user_submoduls)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$user_submoduls
            ],201);
        }
    }

    public function list()  {
        $user_submoduls = user_submoduls::select("*", "user_submoduls.id AS PK", "user_submoduls.FK_users AS FK_users") -> 
                                            join('users', 'users.id', '=', 'user_submoduls.FK_users') -> 
                                            join('user_admins', 'user_admins.id', '=', 'user_submoduls.FK_useradmin') -> 
                                            join('sub_moduls', 'sub_moduls.id', '=', 'user_submoduls.FK_submodul') -> 
                                            join('moduls', 'moduls.id', '=', 'user_admins.FK_modul') -> 
                                            join('kampuses', 'kampuses.id', '=', 'user_admins.FK_kampus') -> 
                                            join('klusters', 'klusters.id', '=', 'user_admins.FK_kluster') -> 
                                            join('units', 'units.id', '=', 'user_admins.FK_unit') -> 
                                            join('negeris', 'negeris.id', '=', 'kampuses.FK_negeri') -> 
                                            join('capaians', 'capaians.id', '=', 'user_submoduls.FK_capaian') -> 
                                            where('user_submoduls.statusrekod','1') -> where('kampuses.statusrekod','1') -> where('users.statusrekod','1') -> 
                                            where('user_admins.statusrekod','1') -> where('sub_moduls.statusrekod','1') -> where('capaians.statusrekod','1') -> 
                                            get(); // list all data

        if ($user_submoduls)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$user_submoduls
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $FK_users = $request->input('FK_users');
        $FK_useradmin = $request->input('FK_useradmin');
        $FK_submodul = $request->input('FK_submodul');
        $FK_capaian = $request->input('FK_capaian');
        $updated_by = $request->input('updated_by');

        $user_submoduls = user_submoduls::find($id); 

        $user_submoduls -> update([
            'FK_users' => $FK_users,
            'FK_useradmin' => $FK_useradmin,
            'FK_submodul' => $FK_submodul,
            'FK_capaian' => $FK_capaian,
            'updated_by' => $updated_by
        ]);

        if ($user_submoduls)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $user_submoduls
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

        $user_submoduls = user_submoduls::find($id); 
        
        $user_submoduls -> update([
            'statusrekod' => '0',
        ]);

        if ($user_submoduls)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $user_submoduls
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
