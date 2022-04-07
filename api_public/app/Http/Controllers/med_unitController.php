<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_unit;

class med_unitController extends Controller
{
    public function register(Request $request) {
        $nama_unit = $request->input('nama_unit');
        $FK_kluster = $request->input('FK_kluster');
        $FK_subkluster = $request->input('FK_subkluster');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $register = med_unit::create([
            'nama_unit' => $nama_unit,
            'FK_kluster' => $FK_kluster,
            'FK_subkluster' => $FK_subkluster,
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
        $id = $request->input('id_unit');

        $med_unit = med_unit::where('id_unit',$id)->first();

        if ($med_unit)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_unit
            ],201);
        }
    }

    public function showGet($FK_kluster, $FK_subkluster)  {
        // $id = $request->input('id_unit');

        $med_unit = med_unit::where('FK_kluster',$FK_kluster)->where('FK_subkluster',$FK_subkluster)->get();

        if ($med_unit)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_unit
            ],201);
        }
    }

    public function list()  {
        $med_unit = med_unit::join('med_kluster', 'med_kluster.id_kluster', '=', 'med_unit.FK_kluster') -> 
                            join('med_subkluster', 'med_subkluster.id_subkluster', '=', 'med_unit.FK_subkluster') -> 
                            where('med_unit.statusrekod','1') -> where('med_kluster.statusrekod','1') -> where('med_subkluster.statusrekod','1') -> get(); // list all data

        if ($med_unit)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_unit
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_unit');
        $nama_unit = $request->input('nama_unit');
        $FK_kluster = $request->input('FK_kluster');
        $FK_subkluster = $request->input('FK_subkluster');
        $updated_by = $request->input('updated_by');

        $med_unit = med_unit::find($id); 

        $med_unit -> update([
            'nama_unit' => $nama_unit,
            'FK_kluster' => $FK_kluster,
            'FK_subkluster' => $FK_subkluster,
            'updated_by' => $updated_by
        ]);

        if ($med_unit)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_unit
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
        $id = $request->input('id_unit');

        $med_unit = med_unit::find($id); 
        
        $med_unit -> update([
            'statusrekod' => '0',
        ]);

        if ($med_unit)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_unit
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
