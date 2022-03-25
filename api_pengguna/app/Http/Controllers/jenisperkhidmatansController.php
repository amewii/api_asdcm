<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\jenisperkhidmatans;

class jenisperkhidmatansController extends Controller
{
    public function register(Request $request) {
        $nama_jenisperkhidmatan = $request->input('nama_jenisperkhidmatan');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');
        $statusrekod = $request->input('statusrekod');

        $register = jenisperkhidmatans::create([
            'nama_jenisperkhidmatan' => $nama_jenisperkhidmatan,
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

        $jenisperkhidmatans = jenisperkhidmatans::where('id',$id)->first();

        if ($jenisperkhidmatans)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$jenisperkhidmatans
            ],200);
        }
    }

    public function list()  {
        $jenisperkhidmatans = jenisperkhidmatans::where('statusrekod','1') -> get();

        if ($jenisperkhidmatans)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$jenisperkhidmatans
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_jenisperkhidmatan = $request->input('nama_jenisperkhidmatan');
        $updated_by = $request->input('updated_by');

        $jenisperkhidmatans = jenisperkhidmatans::find($id); 

        $jenisperkhidmatans -> update([
            'nama_jenisperkhidmatan' => $nama_jenisperkhidmatan,
            'updated_by' => $updated_by
        ]);

        if ($jenisperkhidmatans)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $jenisperkhidmatans
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

        $jenisperkhidmatans = jenisperkhidmatans::find($id); 

        $jenisperkhidmatans -> update([
            'statusrekod' => '0',
        ]);

        if ($jenisperkhidmatans)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $jenisperkhidmatans
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
