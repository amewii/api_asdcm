<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\kategoriperkhidmatans;

class kategoriperkhidmatansController extends Controller
{
    public function register(Request $request) {
        $nama_kategoriperkhidmatan = $request->input('nama_kategoriperkhidmatan');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');
        $statusrekod = $request->input('statusrekod');

        $register = kategoriperkhidmatans::create([
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
        $id = $request->input('id');

        $kategoriperkhidmatans = kategoriperkhidmatans::where('id',$id)->first();

        if ($kategoriperkhidmatans)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$kategoriperkhidmatans
            ],200);
        }
    }

    public function list()  {
        $kategoriperkhidmatans = kategoriperkhidmatans::where('statusrekod','1') -> get();

        if ($kategoriperkhidmatans)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$kategoriperkhidmatans
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_kategoriperkhidmatan = $request->input('nama_kategoriperkhidmatan');
        $updated_by = $request->input('updated_by');

        $kategoriperkhidmatans = kategoriperkhidmatans::find($id); 

        $kategoriperkhidmatans -> update([
            'nama_kategoriperkhidmatan' => $nama_kategoriperkhidmatan,
            'updated_by' => $updated_by
        ]);

        if ($kategoriperkhidmatans)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $kategoriperkhidmatans
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

        $kategoriperkhidmatans = kategoriperkhidmatans::find($id); 

        $kategoriperkhidmatans -> update([
            'statusrekod' => '0',
        ]);

        if ($kategoriperkhidmatans)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $kategoriperkhidmatans
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
