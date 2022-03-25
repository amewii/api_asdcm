<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_kategoriprograms;

class med_kategoriprogramsController extends Controller
{
    public function register(Request $request) {
        $kod_kategori = $request->input('kod_kategori');
        $nama_kategori = $request->input('nama_kategori');
        $bilangan_fail = $request->input('bilangan_fail');
        $kod_format = $request->input('kod_format');
        $saiz_fail = $request->input('saiz_fail');
        $created_by = $request->input('created_by'); // Pakai IC
        $updated_by = $request->input('updated_by'); // Pakai IC
        $statusrekod = $request->input('statusrekod');

        $register = med_kategoriprograms::create([
            'kod_kategori' => $kod_kategori,
            'nama_kategori' => $nama_kategori,
            'bilangan_fail' => $bilangan_fail,
            'kod_format' => $kod_format,
            'saiz_fail' => $saiz_fail,
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

        $med_kategoriprograms = med_kategoriprograms::where('id',$id)->first();

        if ($med_kategoriprograms)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_kategoriprograms
            ],200);
        }
    }

    public function list()  {
        $med_kategoriprograms = med_kategoriprograms::where('.statusrekod','1') -> get(); // list all data

        if ($med_kategoriprograms)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_kategoriprograms
            ],200);
        }
        
    }

    public function listall()  {
        $med_kategoriprograms = med_kategoriprograms::get(); // list all data

        if ($med_kategoriprograms)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_kategoriprograms
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $kod_kategori = $request->input('kod_kategori');
        $nama_kategori = $request->input('nama_kategori');
        $bilangan_fail = $request->input('bilangan_fail');
        $kod_format = $request->input('kod_format');
        $saiz_fail = $request->input('saiz_fail');
        $updated_by = $request->input('updated_by'); // Pakai IC

        $med_kategoriprograms = med_kategoriprograms::find($id); 

        $med_kategoriprograms -> update([
            'kod_kategori' => $kod_kategori,
            'nama_kategori' => $nama_kategori,
            'bilangan_fail' => $bilangan_fail,
            'kod_format' => $kod_format,
            'saiz_fail' => $saiz_fail,
            'updated_by' => $updated_by
        ]);

        if ($med_kategoriprograms)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_kategoriprograms
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

        $med_kategoriprograms = med_kategoriprograms::find($id); 

        switch($med_kategoriprograms->statusrekod)    {
            case 0: $med_kategoriprograms -> update([
                        'statusrekod' => '1',
                    ]);
                    break;
            case 1: $med_kategoriprograms -> update([
                        'statusrekod' => '0',
                    ]);
                    break;
        }
        
        if ($med_kategoriprograms)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_kategoriprograms
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
