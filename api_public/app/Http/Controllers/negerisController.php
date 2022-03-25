<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\negeris;

class negerisController extends Controller
{
    public function register(Request $request) {
        $nama_negeri = $request->input('nama_negeri');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $register = negeris::create([
            'nama_negeri' => $nama_negeri,
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

        $negeris = negeris::where('id',$id)->first();

        if ($negeris)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$negeris
            ],201);
        }
    }

    public function list()  {
        $negeris = negeris::where('statusrekod','1') -> get(); // list all data

        if ($negeris)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$negeris
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_negeri = $request->input('nama_negeri');
        $updated_by = $request->input('updated_by');

        $negeris = negeris::find($id); 

        $negeris -> update([
            'nama_negeri' => $nama_negeri,
            'updated_by' => $updated_by
        ]);

        if ($negeris)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $negeris
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

        $negeris = negeris::where('id',$id) -> update([
            'statusrekod' => '0',
        ]);

        if ($negeris)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $negeris
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
