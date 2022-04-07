<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_kluster;

class med_klusterController extends Controller
{
    public function register(Request $request) {
        $nama_kluster = $request->input('nama_kluster');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $register = med_kluster::create([
            'nama_kluster' => $nama_kluster,
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
        $id = $request->input('id_kluster');

        $med_kluster = med_kluster::where('id_kluster',$id)->first();

        if ($med_kluster)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_kluster
            ],201);
        }
    }

    public function showGet($FK_kampus)  {
        // $id = $request->input('id_subkluster');

        $med_kluster = med_kluster::where('FK_kampus',$FK_kampus)->get();

        if ($med_kluster)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_kluster
            ],201);
        }
    }

    public function list()  {
        $med_kluster = med_kluster::where('statusrekod','1') -> get(); // list all data

        if ($med_kluster)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_kluster
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_kluster');
        $nama_kluster = $request->input('nama_kluster');
        $updated_by = $request->input('updated_by');

        $med_kluster = med_kluster::find($id); 

        $med_kluster -> update([
            'nama_kluster' => $nama_kluster,
            'updated_by' => $updated_by
        ]);

        if ($med_kluster)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_kluster
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
        $id = $request->input('id_kluster');

        $med_kluster = med_kluster::find($id); 

        $med_kluster -> update([
            'statusrekod' => '0',
        ]);

        if ($med_kluster)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_kluster
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
