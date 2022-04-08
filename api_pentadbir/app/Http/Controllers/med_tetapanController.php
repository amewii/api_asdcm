<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_tetapan;

class med_tetapanController extends Controller
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

        $register = med_tetapan::create([
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
        $id = $request->input('id_tetapan');

        $med_tetapan = med_tetapan::where('id_tetapan',$id)->first();

        if ($med_tetapan)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_tetapan
            ],200);
        }
    }

    public function list()  {
        $med_tetapan = med_tetapan::where('statusrekod','1') -> first();

        if ($med_tetapan)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_tetapan
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_tetapan');
        $nama_sistem = $request->input('nama_sistem');
        $versi_sistem = $request->input('versi_sistem');
        $pelepasan_sistem = $request->input('pelepasan_sistem');
        $status_sistem = $request->input('status_sistem');
        $min_katalaluan = $request->input('min_katalaluan');
        $polisi_katalaluan = $request->input('polisi_katalaluan');
        $active_until = $request->input('active_until');
        $mail_gateway = $request->input('mail_gateway');
        $mail_username = $request->input('mail_username');
        $mail_password = $request->input('mail_password');
        $mail_smtp_secure = $request->input('mail_smtp_secure');
        $mail_port = $request->input('mail_port');
        $link_sistem = $request->input('link_sistem');
        $updated_by = $request->input('updated_by');

        // $med_tetapan = med_tetapan::find($id); 

        $med_tetapan = med_tetapan::where('id_tetapan',$id)  -> update([
            'nama_sistem' => $nama_sistem,
            'versi_sistem' => $versi_sistem,
            'pelepasan_sistem' => $pelepasan_sistem,
            'status_sistem' => $status_sistem,
            'min_katalaluan' => $min_katalaluan,
            'polisi_katalaluan' => $polisi_katalaluan,
            'active_until' => $active_until,
            'mail_gateway' => $mail_gateway,
            'mail_username' => $mail_username,
            'mail_password' => $mail_password,
            'mail_smtp_secure' => $mail_smtp_secure,
            'mail_port' => $mail_port,
            'link_sistem' => $link_sistem,
            'updated_by' => $updated_by
        ]);

        if ($med_tetapan)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_tetapan
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
        $id = $request->input('id_tetapan');

        // $med_tetapan = med_tetapan::find($id); 

        $med_tetapan = med_tetapan::where('id_tetapan',$id) -> update([
            'statusrekod' => '0',
        ]);

        if ($med_tetapan)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_tetapan
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
