<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\agensis;

class agensisController extends Controller
{
    public function register(Request $request) {
        $nama_agensi = $request->input('nama_agensi');
        $kod_agensi = $request->input('kod_agensi');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');
        $statusrekod = $request->input('statusrekod');

        $register = agensis::create([
            'nama_agensi' => $nama_agensi,
            'kod_agensi' => $kod_agensi,
            'created_by' => $created_by,
            'updated_by' => $updated_by,
            'statusrekod' => $statusrekod
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

        $agensis = agensis::select("*", "agensis.id AS PK") -> 
                            where('id',$id)->where('statusrekod','1')->first();

        if ($agensis)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$agensis
            ],201);
        }
    }

    public function list()  {
        $agensis = agensis::select("*", "agensis.id AS PK") -> 
                            where('agensis.statusrekod','1') -> get(); // list all data

        if ($agensis)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$agensis
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_agensi = $request->input('nama_agensi');
        $kod_agensi = $request->input('kod_agensi');
        $updated_by = $request->input('updated_by');

        $agensis = agensis::find($id); 

        $agensis -> update([
            'nama_agensi' => $nama_agensi,
            'kod_agensi' => $kod_agensi,
            'updated_by' => $updated_by
        ]);

        if ($agensis)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $agensis
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

        $agensis = agensis::find($id); 
        
        $agensis -> update([
            'statusrekod' => '0',
        ]);

        if ($agensis)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $agensis
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
