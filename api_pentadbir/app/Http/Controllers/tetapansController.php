<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\tetapans;

class tetapansController extends Controller
{
    public function register(Request $request) {
        $nama_sistem = $request->input('nama_sistem');
        $versi_sistem = $request->input('versi_sistem');
        $pelepasan_sistem = $request->input('pelepasan_sistem');
        $status_sistem = $request->input('status_sistem');
        $min_katalaluan = $request->input('min_katalaluan');
        $polisi_katalaluan = $request->input('polisi_katalaluan');
        $active_until = $request->input('active_until');
        $created_by = $request->input('created_by');
        $updated_by = $request->input('updated_by');
        $statusrekod = $request->input('statusrekod');

        $register = tetapans::create([
            'nama_sistem' => $nama_sistem,
            'versi_sistem' => $versi_sistem,
            'pelepasan_sistem' => $pelepasan_sistem,
            'status_sistem' => $status_sistem,
            'min_katalaluan' => $min_katalaluan,
            'polisi_katalaluan' => $polisi_katalaluan,
            'active_until' => $active_until,
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

        $tetapans = tetapans::where('id',$id)->first();

        if ($tetapans)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$tetapans
            ],200);
        }
    }

    public function list()  {
        $tetapans = tetapans::where('statusrekod','1') -> first();

        if ($tetapans)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$tetapans
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_sistem = $request->input('nama_sistem');
        $versi_sistem = $request->input('versi_sistem');
        $pelepasan_sistem = $request->input('pelepasan_sistem');
        $status_sistem = $request->input('status_sistem');
        $min_katalaluan = $request->input('min_katalaluan');
        $polisi_katalaluan = $request->input('polisi_katalaluan');
        $active_until = $request->input('active_until');
        $updated_by = $request->input('updated_by');

        $tetapans = tetapans::find($id); 

        $tetapans -> update([
            'nama_sistem' => $nama_sistem,
            'versi_sistem' => $versi_sistem,
            'pelepasan_sistem' => $pelepasan_sistem,
            'status_sistem' => $status_sistem,
            'min_katalaluan' => $min_katalaluan,
            'polisi_katalaluan' => $polisi_katalaluan,
            'active_until' => $active_until,
            'updated_by' => $updated_by
        ]);

        if ($tetapans)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $tetapans
            ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>"Kemaskini Gagal!",
                'data'=>''
            ],200);
        }
    }

    public function delete(Request $request)    {
        $id = $request->input('id');

        $tetapans = tetapans::find($id); 

        $tetapans -> update([
            'statusrekod' => '0',
        ]);

        if ($tetapans)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $tetapans
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
