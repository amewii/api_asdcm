<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\subklusters;

class subklustersController extends Controller
{
    public function register(Request $request) {
        $nama_subkluster = $request->input('nama_subkluster');
        $FK_kluster = $request->input('FK_kluster');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $register = subklusters::create([
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
        $id = $request->input('id');

        $subklusters = subklusters::where('id',$id)->first();

        if ($subklusters)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$subklusters
            ],201);
        }
    }

    public function showGet($FK_kluster)  {
        // $id = $request->input('id');

        $subklusters = subklusters::where('FK_kluster',$FK_kluster)->get();

        if ($subklusters)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$subklusters
            ],201);
        }
    }

    public function list()  {
        $subklusters = subklusters::select("*", "subklusters.id AS PK") -> 
                        join('klusters', 'klusters.id', '=', 'subklusters.FK_kluster') -> 
                        where('subklusters.statusrekod','1') -> where('klusters.statusrekod','1') -> get(); // list all data

        if ($subklusters)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$subklusters
            ],200);
        }
        
    }

    public function listall()  {
        $subklusters = subklusters::select("*", "subklusters.id AS PK", "subklusters.statusrekod AS subklusterstatusrekod") -> 
                                    join('klusters', 'klusters.id', '=', 'subklusters.FK_kluster') -> 
                                    get(); // list all data

        if ($subklusters)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$subklusters
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_subkluster = $request->input('nama_subkluster');
        $FK_kluster = $request->input('FK_kluster');
        $updated_by = $request->input('updated_by');

        $subklusters = subklusters::find($id); 

        $subklusters -> update([
            'nama_subkluster' => $nama_subkluster,
            'FK_kluster' => $FK_kluster,
            'updated_by' => $updated_by
        ]);

        if ($subklusters)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $subklusters
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

        $subklusters = subklusters::find($id); 
        
        switch($subklusters->statusrekod)    {
            case 0: $subklusters -> update([
                        'statusrekod' => '1',
                    ]);
                    break;
            case 1: $subklusters -> update([
                        'statusrekod' => '0',
                    ]);
                    break;
        }

        if ($subklusters)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $subklusters
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
