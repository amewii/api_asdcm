<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\units;

class unitsController extends Controller
{
    public function register(Request $request) {
        $nama_unit = $request->input('nama_unit');
        $FK_kluster = $request->input('FK_kluster');
        $FK_subkluster = $request->input('FK_subkluster');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $register = units::create([
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
        $id = $request->input('id');

        $units = units::where('id',$id)->first();

        if ($units)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$units
            ],201);
        }
    }

    public function showGet($FK_kluster, $FK_subkluster)  {
        // $id = $request->input('id');

        $units = units::where('FK_kluster',$FK_kluster)->where('FK_subkluster',$FK_subkluster)->get();

        if ($units)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$units
            ],201);
        }
    }

    public function list()  {
        $units = units::select("*", "units.id AS PK") -> 
                        join('klusters', 'klusters.id', '=', 'units.FK_kluster') -> 
                        join('subklusters', 'subklusters.id', '=', 'units.FK_subkluster') -> 
                        where('units.statusrekod','1') -> where('klusters.statusrekod','1') -> where('subklusters.statusrekod','1') -> get(); // list all data

        if ($units)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$units
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_unit = $request->input('nama_unit');
        $FK_kluster = $request->input('FK_kluster');
        $FK_subkluster = $request->input('FK_subkluster');
        $updated_by = $request->input('updated_by');

        $units = units::find($id); 

        $units -> update([
            'nama_unit' => $nama_unit,
            'FK_kluster' => $FK_kluster,
            'FK_subkluster' => $FK_subkluster,
            'updated_by' => $updated_by
        ]);

        if ($units)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $units
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

        $units = units::find($id); 
        
        $units -> update([
            'statusrekod' => '0',
        ]);

        if ($units)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $units
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
