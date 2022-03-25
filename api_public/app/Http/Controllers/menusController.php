<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\menus;

class menusController extends Controller
{
    public function register(Request $request) {
        $FK_parent = $request->input('FK_parent');
        $is_parent = $request->input('is_parent');
        $id_menu = $request->input('id_menu');
        $nama_menu = $request->input('nama_menu');
        $nama_fail = $request->input('nama_fail');
        $nama_icon = $request->input('nama_icon');
        $modul = $request->input('modul');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $register = menus::create([
            'FK_parent' => $FK_parent,
            'is_parent' => $is_parent,
            'id_menu' => $id_menu,
            'nama_menu' => $nama_menu,
            'nama_fail' => $nama_fail,
            'nama_icon' => $nama_icon,
            'modul' => $modul,
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
                'message'=>'Tak Jadi Boss',
                'data'=>$register
            ],405);
        }
    }

    public function show(Request $request)  {
        $id = $request->input('id');

        $menus = menus::where('id',$id)->first();

        if ($menus)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$menus
            ],201);
        }
    }

    public function list()  {
        $menus = menus::select("menus.id AS PK", "menus.FK_parent AS FK_parent", "menus.nama_fail AS fail", "menus.id_menu AS idmenu", "menus.nama_menu AS menu", "menus.nama_icon AS icon", "menus.modul AS modul", "menus.is_parent as bapak", 
                                "parent.nama_fail AS parent_fail", "parent.id_menu AS parent_idmenu", "parent.nama_menu AS parent_menu") -> 
                        leftjoin('menus as parent', 'parent.id', '=', 'menus.FK_parent') -> 
                        where('menus.statusrekod','1') -> get(); // list all data

        if ($menus)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$menus
            ],200);
        }
        
    }

    public function top()  {
        $menus = menus::select("*", "menus.is_parent as bapak") -> 
                        where('FK_parent',"0") ->
                        get(); // list all data

        if ($menus)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$menus
            ],200);
        }
        
    }

    public function mid($FK_parent)  {
        $menus = menus::select("*", "menus.is_parent as bapak") -> 
                        where('FK_parent',$FK_parent) ->
                        get(); // list all data

        if ($menus)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$menus
            ],200);
        }
        
    }

    public function bot($FK_parent)  {
        $menus = menus::where('FK_parent',$FK_parent) ->
                        get(); // list all data

        if ($menus)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$menus
            ],200);
        }
        
    }

public function update(Request $request)    {
        $id = $request->input('id');
        $nama_menu = $request->input('nama_menu');
        $updated_by = $request->input('updated_by');

        $menus = menus::find($id); 

        $menus -> update([
            'nama_menu' => $nama_menu,
            'updated_by' => $updated_by
        ]);

        if ($menus)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $menus
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

        $menus = menus::find($id); 
        
        $menus -> update([
            'statusrekod' => '0',
        ]);

        if ($menus)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $menus
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
