<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_permohonan;
use Illuminate\Support\Facades\File;
use ZipArchive;
use Carbon\Carbon;

class med_permohonanController extends Controller
{
    public function register(Request $request) {
        $FK_users = $request->input('FK_users');
        $sebab = $request->input('sebab');
        $FK_program = $request->input('FK_program');
        $status_permohonan = $request->input('status_permohonan');
        $tarikh_permohonan = $request->input('tarikh_permohonan');
        $media_list = $request->input('media_list');
        $created_by = $request->input('created_by'); 
        $updated_by = $request->input('updated_by'); 
        $statusrekod = $request->input('statusrekod');

        $register = med_permohonan::create([
            'FK_users' => $FK_users,
            'sebab' => $sebab,
            'FK_program' => $FK_program,
            'status_permohonan' => $status_permohonan,
            'tarikh_permohonan' => $tarikh_permohonan,
            'media_list' => $media_list,
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
        $id = $request->input('id_permohonan');

        $med_permohonan = med_permohonan::where('id_permohonan',$id)->first();

        if ($med_permohonan)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_permohonan
            ],200);
        }
    }

    public function showGet($id)  {

        $med_permohonan = med_permohonan::  join('med_users', 'med_users.id_users', '=', 'med_permohonan.FK_users') -> 
                                            join('med_program', 'med_program.id_program', '=', 'med_permohonan.FK_program') -> 
                                            where('med_permohonan.id_permohonan',$id)->first();

                                            // dd( $med_permohonan);

        if ($med_permohonan)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_permohonan
            ],200);
        }
    }

    public function showGetUsers($FK_users)  {

        $med_permohonan = med_permohonan::  join('med_users', 'med_users.id_users', '=', 'med_permohonan.FK_users') -> 
                                            join('med_program', 'med_program.id_program', '=', 'med_permohonan.FK_program') -> 
                                            join('med_status', 'med_status.id_status', '=', 'med_permohonan.status_permohonan') -> 
                                            where('med_permohonan.statusrekod','1') -> where('med_users.statusrekod','1') -> where('med_permohonan.FK_users',$FK_users)->get();

        if ($med_permohonan)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_permohonan
            ],200);
        }
    }

    public function list()  {
        $med_permohonan = med_permohonan::  join('med_users', 'med_users.id_users', '=', 'med_permohonan.FK_users') -> 
                                            join('med_program', 'med_program.id_program', '=', 'med_permohonan.FK_program') -> 
                                            join('med_status', 'med_status.id_status', '=', 'med_permohonan.status_permohonan') -> 
                                            where('med_permohonan.statusrekod','1') -> where('med_users.statusrekod','1') -> where('med_permohonan.statusrekod','1') -> 
                                            orderBy('tarikh_permohonan', 'desc') ->
                                            get(); // list all data

        if ($med_permohonan)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_permohonan
            ],200);
        }
        
    }

    public function listFilter($FK_peranan,$FK_kluster)  {

        $med_permohonan = '';
        if($FK_peranan == 2){
            $med_permohonan = med_permohonan::  join('med_users', 'med_users.id_users', '=', 'med_permohonan.FK_users') -> 
                                                join('med_program', 'med_program.id_program', '=', 'med_permohonan.FK_program') -> 
                                                join('med_status', 'med_status.id_status', '=', 'med_permohonan.status_permohonan') -> 
                                                where('med_permohonan.statusrekod','1') -> where('med_users.statusrekod','1') -> where('med_permohonan.statusrekod','1') -> 
                                                where('med_program.FK_kluster',$FK_kluster) ->
                                                orderBy('tarikh_permohonan', 'desc') ->
                                                get(); // list all data
        }else if($FK_peranan == 3){

        }
        

        if ($med_permohonan)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_permohonan
            ],200);
        }
        
    }

    public function listtahun()  {
        $med_programs = med_permohonan::select(med_permohonan::raw("substr(tarikh_permohonan,1,4) as tahun")) -> 
                        groupBy('tahun')->
                        get(); // list all data

        if ($med_programs)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_programs
            ],200);
        }
        
    }

    public function listStatus($status_permohonan)  {
        $med_permohonan = med_permohonan::  join('med_users', 'med_users.id_users', '=', 'med_permohonan.FK_users') -> 
                                            join('med_program', 'med_program.id_program', '=', 'med_permohonan.FK_program') -> 
                                            join('med_status', 'med_status.id_status', '=', 'med_permohonan.status_permohonan') -> 
                                            where('med_permohonan.statusrekod','1') -> where('med_users.statusrekod','1') -> where('med_permohonan.statusrekod','1') -> 
                                            where('med_permohonan.status_permohonan',$status_permohonan) -> 
                                            orderBy('tarikh_permohonan', 'desc') ->
                                            get(); // list all data

        if ($med_permohonan)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_permohonan
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_permohonan');
        $status_permohonan = $request->input('status_permohonan');
        $tarikh_pengesahan = $request->input('tarikh_pengesahan');
        $tarikh_luput = $request->input('tarikh_luput');
        $tempoh = $request->input('tempoh');
        $pegawai_pelulus = $request->input('pegawai_pelulus');
        $updated_by = $request->input('updated_by');

        $med_permohonan = med_permohonan::where('id_permohonan',$id)-> update([
            'status_permohonan' => $status_permohonan,
            'tarikh_pengesahan' => $tarikh_pengesahan,
            'tarikh_luput' => $tarikh_luput,
            'pegawai_pelulus' => $pegawai_pelulus,
            'updated_by' => $updated_by
        ]);

        $date = Carbon::createFromFormat('Y-m-d', $tarikh_luput);
        $tarikh_luput = $date->addDays($tempoh);
        
        $med_permohonan = med_permohonan::where('id_permohonan',$id)-> update([
            'tarikh_luput' => $tarikh_luput,
        ]);

        if ($med_permohonan)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_permohonan
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

    public function updateLuput(Request $request)    {
        $id = $request->input('id_permohonan');
        $status_permohonan = $request->input('status_permohonan');

        $med_permohonan = med_permohonan::where('id_permohonan',$id) -> update([
            'status_permohonan' => $status_permohonan
        ]);

        if ($med_permohonan)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_permohonan
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
        $id = $request->input('id_permohonan');

        $med_permohonan = med_permohonan::where('id_permohonan',$id) -> update([
            'statusrekod' => '0',
        ]);

        if ($med_permohonan)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_permohonan
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

    //MIMI : ZIP & DOWNLOAD SELECTED FILE START
    public function download (Request $request){
        
        $id_permohonan = $request->input('id_permohonan');
        // $FK_users = $request->input('FK_users');
        // $FK_program = $request->input('FK_program');
        $tarikh_muatturun = $request->input('tarikh_muatturun');

        $med_muatturun = med_permohonan::select('*')->where('id_permohonan',$id_permohonan)->first();
        $FK_program = $med_muatturun->FK_program;
        $FK_users = $med_muatturun->FK_users;
        $media_list = $med_muatturun->media_list;
        $media_item = explode(",", $media_list);

        $zip = new ZipArchive;
        $fileName = $tarikh_muatturun.'_'.$FK_program.'_'.$FK_users.'.zip';
        if($zip->open(public_path($fileName),ZipArchive::CREATE) === TRUE)
        {
            $files = File::files(public_path('uploads'));
            foreach($files as $key => $value){
                
                foreach($media_item as $key_item => $value_item){
                
                    $relativeNameInZipFile = basename($value);

                    if($value_item == $relativeNameInZipFile){
                        $zip->addFile($value,$relativeNameInZipFile);
                    }
                }

            }
            $zip->close();
        }
        if ($zip)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Muatturun!",
                'data' => $fileName
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
    //MIMI : ZIP & DOWNLOAD SELECTED FILE END

    //MIMI : REMOVE ZIP FILE START
    public function remove (Request $request){
        
        $file_name = $request->input('file_name');

        if(File::exists(public_path($file_name))){
            File::delete(public_path($file_name));
        }else{
            dd('File does not exists.');
        }

        return response()->json([
            'success'=>true,
            'message'=>"Berjaya Muatturun!",
        ],200);
        
    }
    //MIMI : REMOVE ZIP FILE END
}
