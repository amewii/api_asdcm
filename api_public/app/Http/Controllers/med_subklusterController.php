<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_subkluster;

class med_subklusterController extends Controller
{
    public function register(Request $request) {
        $nama_subkluster = $request->input('nama_subkluster');
        $FK_kluster = $request->input('FK_kluster');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $register = med_subkluster::create([
            'nama_subkluster' => $nama_subkluster,
            'FK_kluster' => $FK_kluster,
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
        $id = $request->input('id_subkluster');

        $med_subkluster = med_subkluster::where('id_subkluster',$id)->first();

        if ($med_subkluster)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_subkluster
            ],201);
        }
    }

    public function showGet($FK_kluster)  {
        // $id = $request->input('id_subkluster');

        $med_subkluster = med_subkluster::where('FK_kluster',$FK_kluster)->get();

        if ($med_subkluster)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_subkluster
            ],201);
        }
    }

    public function list()  {
        $med_subkluster = med_subkluster::join('med_kluster', 'med_kluster.id_kluster', '=', 'med_subkluster.FK_kluster') -> 
                                        where('med_subkluster.statusrekod','1') -> where('med_kluster.statusrekod','1') -> get(); // list all data

        if ($med_subkluster)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_subkluster
            ],200);
        }
        
    }

    public function listall()  {
        $med_subkluster = med_subkluster::select("*", "med_subkluster.statusrekod AS med_subklustertatusrekod") -> 
                                    join('med_kluster', 'med_kluster.id_kluster', '=', 'med_subkluster.FK_kluster') -> 
                                    get(); // list all data

        if ($med_subkluster)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_subkluster
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_subkluster');
        $nama_subkluster = $request->input('nama_subkluster');
        $FK_kluster = $request->input('FK_kluster');
        $updated_by = $request->input('updated_by');

        $med_subkluster = med_subkluster::find($id); 

        $med_subkluster -> update([
            'nama_subkluster' => $nama_subkluster,
            'FK_kluster' => $FK_kluster,
            'updated_by' => $updated_by
        ]);

        if ($med_subkluster)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_subkluster
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
        $id = $request->input('id_subkluster');

        $med_subkluster = med_subkluster::find($id); 
        
        switch($med_subkluster->statusrekod)    {
            case 0: $med_subkluster -> update([
                        'statusrekod' => '1',
                    ]);
                    break;
            case 1: $med_subkluster -> update([
                        'statusrekod' => '0',
                    ]);
                    break;
        }

        if ($med_subkluster)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_subkluster
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
