<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_menu;

class med_menuController extends Controller
{
    public function register(Request $request) {
        $FK_parent = $request->input('FK_parent');
        $is_parent = $request->input('is_parent');
        $id_nama_menu = $request->input('id_nama_menu');
        $nama_menu = $request->input('nama_menu');
        $nama_fail = $request->input('nama_fail');
        $nama_icon = $request->input('nama_icon');
        $modul = $request->input('modul');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $register = med_menu::create([
            'FK_parent' => $FK_parent,
            'is_parent' => $is_parent,
            'id_nama_menu' => $id_nama_menu,
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
        $id = $request->input('id_menu');

        $med_menu = med_menu::where('id_menu',$id)->first();

        if ($med_menu)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_menu
            ],201);
        }
    }

    public function list()  {
        $med_menu = med_menu::select("med_menu.id_menu AS PK", "med_menu.FK_parent AS FK_parent", "med_menu.nama_fail AS fail", "med_menu.id_nama_menu AS idmenu", "med_menu.nama_menu AS menu", "med_menu.nama_icon AS icon", "med_menu.modul AS modul", "med_menu.is_parent as bapak", 
                                "parent.nama_fail AS parent_fail", "parent.id_nama_menu AS parent_idmenu", "parent.nama_menu AS parent_menu") -> 
                        leftjoin('med_menu as parent', 'parent.id_menu', '=', 'med_menu.FK_parent') -> 
                        where('med_menu.statusrekod','1') -> get(); // list all data

        if ($med_menu)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_menu
            ],200);
        }
        
    }

    public function top()  {
        $med_menu = med_menu::select("*", "med_menu.is_parent as bapak") -> 
                        where('FK_parent',"0") ->
                        get(); // list all data

        if ($med_menu)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_menu
            ],200);
        }
        
    }

    public function mid($FK_parent)  {
        $med_menu = med_menu::select("*", "med_menu.is_parent as bapak") -> 
                        where('FK_parent',$FK_parent) ->
                        get(); // list all data

        if ($med_menu)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_menu
            ],200);
        }
        
    }

    public function bot($FK_parent)  {
        $med_menu = med_menu::where('FK_parent',$FK_parent) ->
                        get(); // list all data

        if ($med_menu)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_menu
            ],200);
        }
        
    }

public function update(Request $request)    {
        $id = $request->input('id_menu');
        $nama_menu = $request->input('nama_menu');
        $updated_by = $request->input('updated_by');

        $med_menu = med_menu::find($id); 

        $med_menu -> update([
            'nama_menu' => $nama_menu,
            'updated_by' => $updated_by
        ]);

        if ($med_menu)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_menu
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
        $id = $request->input('id_menu');

        $med_menu = med_menu::find($id); 
        
        $med_menu -> update([
            'statusrekod' => '0',
        ]);

        if ($med_menu)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_menu
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
