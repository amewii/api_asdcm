<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_kategoriprogram;

class med_kategoriprogramController extends Controller
{
    public function register(Request $request) {
        $kod_kategori = $request->input('kod_kategori');
        $nama_kategori = $request->input('nama_kategori');
        $bilangan_fail = $request->input('bilangan_fail');
        // $flag_kod_format = $request->input('flag_kod_format');
        $kod_format = $request->input('kod_format');
        $saiz_fail = $request->input('saiz_fail');
        $created_by = $request->input('created_by'); // Pakai IC
        $updated_by = $request->input('updated_by'); // Pakai IC
        $statusrekod = $request->input('statusrekod');

        $register = med_kategoriprogram::create([
            'kod_kategori' => $kod_kategori,
            'nama_kategori' => $nama_kategori,
            'bilangan_fail' => $bilangan_fail,
            'kod_format' => $kod_format,
            // 'flag_kod_format' => $flag_kod_format,
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
        $id = $request->input('id_kategoriprogram');

        $med_kategoriprogram = med_kategoriprogram::where('id_kategoriprogram',$id)->first();

        if ($med_kategoriprogram)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_kategoriprogram
            ],200);
        }
    }

    public function list()  {
        $med_kategoriprogram = med_kategoriprogram::where('.statusrekod','1') -> get(); // list all data

        if ($med_kategoriprogram)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_kategoriprogram
            ],200);
        }
        
    }

    public function listall()  {
        $med_kategoriprogram = med_kategoriprogram::get(); // list all data

        if ($med_kategoriprogram)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_kategoriprogram
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_kategoriprogram');
        $kod_kategori = $request->input('kod_kategori');
        $nama_kategori = $request->input('nama_kategori');
        $bilangan_fail = $request->input('bilangan_fail');
        $kod_format = $request->input('kod_format');
        // $flag_kod_format = $request->input('flag_kod_format');
        $saiz_fail = $request->input('saiz_fail');
        $updated_by = $request->input('updated_by'); // Pakai IC

        $med_kategoriprogram = med_kategoriprogram::where('id_kategoriprogram',$id) -> update([
            'kod_kategori' => $kod_kategori,
            'nama_kategori' => $nama_kategori,
            'bilangan_fail' => $bilangan_fail,
            'kod_format' => $kod_format,
            // 'flag_kod_format' => $flag_kod_format,
            'saiz_fail' => $saiz_fail,
            'updated_by' => $updated_by
        ]);

        if ($med_kategoriprogram)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_kategoriprogram
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
        $id = $request->input('id_kategoriprogram');

        $med_kategoriprogram_search = med_kategoriprogram::where('id_kategoriprogram',$id) -> first(); 

        switch($med_kategoriprogram_search->statusrekod)    {
            case 0: $med_kategoriprogram = med_kategoriprogram::where('id_kategoriprogram',$id) -> update([
                        'statusrekod' => '1',
                    ]);
                    break;
            case 1: $med_kategoriprogram = med_kategoriprogram::where('id_kategoriprogram',$id) -> update([
                        'statusrekod' => '0',
                    ]);
                    break;
        }
        
        $med_kategoriprogram_search = med_kategoriprogram::where('id_kategoriprogram',$id) -> first(); 
        
        if ($med_kategoriprogram)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_kategoriprogram_search
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
