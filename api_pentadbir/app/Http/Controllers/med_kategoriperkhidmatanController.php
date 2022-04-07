<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_kategoriperkhidmatan;

class med_kategoriperkhidmatanController extends Controller
{
    public function register(Request $request) {
        $nama_kategoriperkhidmatan = $request->input('nama_kategoriperkhidmatan');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');
        $statusrekod = $request->input('statusrekod');

        $register = med_kategoriperkhidmatan::create([
            'nama_kategoriperkhidmatan' => $nama_kategoriperkhidmatan,
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
                'message'=>'Bad Request',
                'data'=>$register
            ],400);
        }
    }

    public function show(Request $request)  {
        $id = $request->input('id_kategoriperkhidmatan');

        $med_kategoriperkhidmatan = med_kategoriperkhidmatan::where('id_kategoriperkhidmatan',$id)->first();

        if ($med_kategoriperkhidmatan)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_kategoriperkhidmatan
            ],200);
        }
    }

    public function list()  {
        $med_kategoriperkhidmatan = med_kategoriperkhidmatan::where('statusrekod','1') -> get();

        if ($med_kategoriperkhidmatan)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_kategoriperkhidmatan
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_kategoriperkhidmatan');
        $nama_kategoriperkhidmatan = $request->input('nama_kategoriperkhidmatan');
        $updated_by = $request->input('updated_by');

        $med_kategoriperkhidmatan = med_kategoriperkhidmatan::find($id); 

        $med_kategoriperkhidmatan -> update([
            'nama_kategoriperkhidmatan' => $nama_kategoriperkhidmatan,
            'updated_by' => $updated_by
        ]);

        if ($med_kategoriperkhidmatan)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_kategoriperkhidmatan
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
        $id = $request->input('id_kategoriperkhidmatan');

        $med_kategoriperkhidmatan = med_kategoriperkhidmatan::find($id); 

        $med_kategoriperkhidmatan -> update([
            'statusrekod' => '0',
        ]);

        if ($med_kategoriperkhidmatan)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_kategoriperkhidmatan
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
