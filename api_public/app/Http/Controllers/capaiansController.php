<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\capaians;

class capaiansController extends Controller
{
    public function register(Request $request) {
        $peranan = $request->input('peranan');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');

        $register = capaians::create([
            'peranan' => $peranan,
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
                'message'=>'Register Failed!',
                'data'=>$register
            ],405);
        }
    }

    public function show(Request $request)  {
        $id = $request->input('id');

        $capaians = capaians::where('id',$id)->first();

        if ($capaians)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$capaians
            ],201);
        }
    }

    public function list()  {
        $capaians = capaians::where('capaians.statusrekod','1') -> get(); // list all data

        if ($capaians)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$capaians
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $peranan = $request->input('peranan');
        $updated_by = $request->input('updated_by');

        $capaians = capaians::find($id); 

        $capaians -> update([
            'peranan' => $peranan,
            'updated_by' => $updated_by
        ]);

        if ($capaians)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $capaians
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

        $capaians = capaians::find($id); 

        $capaians -> update([
            'statusrekod' => '0',
        ]);

        if ($capaians)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $capaians
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
