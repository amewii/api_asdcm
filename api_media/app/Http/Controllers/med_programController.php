<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_program;

class med_programController extends Controller
{
    public function register(Request $request) {
        $nama_program = $request->input('nama_program');
        $tarikh_program = $request->input('tarikh_program');
        $FK_kategori = $request->input('FK_kategori');
        $FK_kluster = $request->input('FK_kluster');
        $FK_subkluster = $request->input('FK_subkluster');
        $FK_kampus = $request->input('FK_kampus');
        $FK_unit = $request->input('FK_unit');
        $FK_vip = $request->input('FK_vip');
        $created_by = $request->input('created_by'); // Pakai IC
        $updated_by = $request->input('updated_by'); // Pakai IC
        $statusrekod = $request->input('statusrekod');

        $register = med_program::create([
            'nama_program' => $nama_program,
            'tarikh_program' => $tarikh_program,
            'FK_kategori' => $FK_kategori,
            'FK_kluster' => $FK_kluster,
            'FK_subkluster' => $FK_subkluster,
            'FK_kampus' => $FK_kampus,
            'FK_unit' => $FK_unit,
            'FK_vip' => $FK_vip,
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

    public function laporan(Request $request)  {
        $FK_kategori = $request->input('FK_kategori');
        $nama_program = $request->input('nama_program');
        $tarikh_mula = $request->input('tarikh_mula');
        $tarikh_akhir = $request->input('tarikh_akhir');
        $FK_kampus = $request->input('FK_kampus');
        $FK_kluster = $request->input('FK_kluster');
        $tahun_program = $request->input('tahun_program');

        $med_program = med_program::select("*", med_program::raw("substr(tarikh_program,1,4) as tahun")) -> 
                                        join('med_kategoriprogram', 'med_kategoriprogram.id_kategoriprogram', '=', 'med_program.FK_kategori') -> 
                                        join('med_kampus', 'med_kampus.id_kampus', '=', 'med_program.FK_kampus') -> 
                                        join('med_kluster', 'med_kluster.id_kluster', '=', 'med_program.FK_kluster') -> 
                                        join('med_subkluster', 'med_subkluster.id_subkluster', '=', 'med_program.FK_subkluster') -> 
                                        join('med_unit', 'med_unit.id_unit', '=', 'med_program.FK_unit');        

        if($FK_kategori != '') {
            $med_program = $med_program -> where('FK_kategori',$FK_kategori);
        }
        if($nama_program != '') {
            $med_program = $med_program -> where('nama_program',$nama_program);
        }
        if($tarikh_mula != '') {
            $med_program = $med_program -> where('tarikh_program','>=',date('Y-m-d',strtotime($tarikh_mula)));
        }
        if($tarikh_akhir != '') {
            $med_program = $med_program -> where('tarikh_program','<=',date('Y-m-d',strtotime($tarikh_akhir)));
        }
        if($FK_kampus != '') {
            $med_program = $med_program -> where('FK_kampus',$FK_kampus);
        }
        if($FK_kluster != '') {
            $med_program = $med_program -> where('FK_kluster',$FK_kluster);
        }
        if($tahun_program != '') {
            $med_program = $med_program -> where(med_program::raw('substr(tarikh_program,1,4)'),date('Y',strtotime($tahun_program)));
        }        

        $med_program = $med_program -> get();

        if ($med_program)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_program
            ],200);
        }
    }

    public function show(Request $request)  {
        $id = $request->input('id_program');

        $med_program = med_program::select("*", "med_program.id AS PK") ->
                                        where('id_program',$id)->first();

        if ($med_program)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_program
            ],200);
        }
    }

    public function showGet(Request $request, $id)  {
        $med_program = med_program::join('med_kategoriprogram', 'med_kategoriprogram.id_kategoriprogram', '=', 'med_program.FK_kategori') -> 
                                    join('med_kampus', 'med_kampus.id_kampus', '=', 'med_program.FK_kampus') -> 
                                    join('med_kluster', 'med_kluster.id_kluster', '=', 'med_program.FK_kluster') -> 
                                    leftjoin('med_subkluster', 'med_subkluster.id_subkluster', '=', 'med_program.FK_subkluster') -> 
                                    leftjoin('med_unit', 'med_unit.id_unit', '=', 'med_program.FK_unit') ->
                                    where('med_program.id_program',$id)->first();

        if ($med_program)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_program
            ],200);
        }
    }

    public function list()  {
        $med_program = med_program::join('med_kategoriprogram', 'med_kategoriprogram.id_kategoriprogram', '=', 'med_program.FK_kategori') -> 
                                    join('med_kampus', 'med_kampus.id_kampus', '=', 'med_program.FK_kampus') -> 
                                    join('med_kluster', 'med_kluster.id_kluster', '=', 'med_program.FK_kluster') -> 
                                    join('med_subkluster', 'med_subkluster.id_subkluster', '=', 'med_program.FK_subkluster') -> 
                                    leftjoin('med_unit', 'med_unit.id_unit', '=', 'med_program.FK_unit') ->
                                    where('med_program.statusrekod','1') -> where('med_kampus.statusrekod','1') -> where('med_kluster.statusrekod','1') -> where('med_unit.statusrekod','1') -> 
                                    get(); // list all data

        if ($med_program)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_program
            ],200);
        }
        
    }

    public function listtahun()  {
        $med_program = med_program::select(med_program::raw("substr(tarikh_program,1,4) as tahun")) ->
                                    where('med_program.statusrekod','1') -> 
                                    groupBy('tahun')->
                                    get(); // list all data

        if ($med_program)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_program
            ],200);
        }
        
    }

    public function listpdf()  {
        $med_program = med_program::join('med_kategoriprogram', 'med_kategoriprogram.id_kategoriprogram', '=', 'med_program.FK_kategori') -> 
                                    join('med_kampus', 'med_kampus.id_kampus', '=', 'med_program.FK_kampus') -> 
                                    join('med_kluster', 'med_kluster.id_kluster', '=', 'med_program.FK_kluster') -> 
                                    join('med_subkluster', 'med_subkluster.id_subkluster', '=', 'med_program.FK_subkluster') -> 
                                    leftjoin('med_unit', 'med_unit.id_unit', '=', 'med_program.FK_unit') ->
                                    where('med_program.statusrekod','1') -> where('med_kampus.statusrekod','1') -> where('med_kluster.statusrekod','1') -> where('med_unit.statusrekod','1') -> 
                                    get(); // list all data
        $html = '<html><body>'
			. '<p>Put your html here, or generate it with your favourite '
			. 'templating system.</p>'
			. '</body></html>';
	// return PDF::load($html, 'A4', 'portrait')->show();
        if ($med_program)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_program
            ],200);
        }
        
    }

    public function listbergambar()  {
        // $med_program = med_program::select("*", "med_program.id_program AS PK") ->
        //                             join('med_kategoriprogram', 'med_kategoriprogram.id_kategoriprogram', '=', 'med_program.FK_kategori') -> 
        //                             join('med_kampus', 'med_kampus.id_kampus', '=', 'med_program.FK_kampus') -> 
        //                             join('med_kluster', 'med_kluster.id_kluster', '=', 'med_program.FK_kluster') -> 
        //                             join('med_unit', 'med_unit.id_unit', '=', 'med_program.FK_unit') ->
        //                             where('med_program.statusrekod','1') -> where('med_kampus.statusrekod','1') -> where('med_kluster.statusrekod','1') -> whereNotNull('media_path') ->
        //                             orderBy('tarikh_program', 'desc') ->
        //                             get(); // list all data

        $med_program = med_program::select("*", "med_program.id_program AS PK") ->
                                    join('med_kategoriprogram', 'med_kategoriprogram.id_kategoriprogram', '=', 'med_program.FK_kategori') -> 
                                    join('med_kampus', 'med_kampus.id_kampus', '=', 'med_program.FK_kampus') -> 
                                    join('med_kluster', 'med_kluster.id_kluster', '=', 'med_program.FK_kluster') -> 
                                    join('med_subkluster', 'med_subkluster.id_subkluster', '=', 'med_program.FK_subkluster') -> 
                                    leftjoin('med_unit', 'med_unit.id_unit', '=', 'med_program.FK_unit') ->
                                    where('med_program.statusrekod','1') -> where('med_kampus.statusrekod','1') -> where('med_kluster.statusrekod','1') -> whereNotNull('media_path') ->
                                    where('med_program.media_path','LIKE','%JPEG%')->orWhere('med_program.media_path','LIKE','%JPG%')->orWhere('med_program.media_path','LIKE','%PNG%')->orWhere('med_program.media_path','LIKE','%BMP%')->orWhere('med_program.media_path','LIKE','%GIF%')->
                                    orderBy('tarikh_program', 'desc') ->
                                    get(); // list all data (MIMI)

        if ($med_program)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_program
            ],200);
        }
        
    }

    public function listvideo()  {
        // $med_program = med_program::select("*", "med_program.id_program AS PK") ->
        //                             join('med_kategoriprogram', 'med_kategoriprogram.id_kategoriprogram', '=', 'med_program.FK_kategori') -> 
        //                             join('med_kampus', 'med_kampus.id_kampus', '=', 'med_program.FK_kampus') -> 
        //                             join('med_kluster', 'med_kluster.id_kluster', '=', 'med_program.FK_kluster') -> 
        //                             join('med_unit', 'med_unit.id_unit', '=', 'med_program.FK_unit') ->
        //                             where('med_program.statusrekod','1') -> where('med_kampus.statusrekod','1') -> where('med_kluster.statusrekod','1') -> whereNotNull('media_path') ->
        //                             orderBy('tarikh_program', 'desc') ->
        //                             get(); // list all data

        $med_program = med_program::select("*", "med_program.id_program AS PK") ->
                                    join('med_kategoriprogram', 'med_kategoriprogram.id_kategoriprogram', '=', 'med_program.FK_kategori') -> 
                                    join('med_kampus', 'med_kampus.id_kampus', '=', 'med_program.FK_kampus') -> 
                                    join('med_kluster', 'med_kluster.id_kluster', '=', 'med_program.FK_kluster') -> 
                                    join('med_subkluster', 'med_subkluster.id_subkluster', '=', 'med_program.FK_subkluster') -> 
                                    leftjoin('med_unit', 'med_unit.id_unit', '=', 'med_program.FK_unit') ->
                                    where('med_program.statusrekod','1') -> where('med_kampus.statusrekod','1') -> where('med_kluster.statusrekod','1') -> whereNotNull('media_path') ->
                                    where('med_program.media_path','LIKE','%MP4%')->whereOr('med_program.media_path','LIKE','%MOV%')->whereOr('med_program.media_path','LIKE','%3GP%') ->
                                    orderBy('tarikh_program', 'desc') ->
                                    get(); // list all data (MIMI)

        if ($med_program)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_program
            ],200);
        }
        
    }

    public function listall()  {
        $med_program = med_program::select("*", "med_program.statusrekod AS programstatusrekod") ->
                                    join('med_kategoriprogram', 'med_kategoriprogram.id_kategoriprogram', '=', 'med_program.FK_kategori') -> 
                                    join('med_kampus', 'med_kampus.id_kampus', '=', 'med_program.FK_kampus') -> 
                                    join('med_kluster', 'med_kluster.id_kluster', '=', 'med_program.FK_kluster') -> 
                                    leftjoin('med_subkluster', 'med_subkluster.id_subkluster', '=', 'med_program.FK_subkluster') -> 
                                    leftjoin('med_unit', 'med_unit.id_unit', '=', 'med_program.FK_unit') ->
                                    get(); // list all data

        if ($med_program)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_program
            ],200);
        }
        
    }

    public function listallbykluster($id)  {
        $med_program = med_program::select("*", "med_program.statusrekod AS programstatusrekod") ->
                                    join('med_kategoriprogram', 'med_kategoriprogram.id_kategoriprogram', '=', 'med_program.FK_kategori') -> 
                                    join('med_kampus', 'med_kampus.id_kampus', '=', 'med_program.FK_kampus') -> 
                                    join('med_kluster', 'med_kluster.id_kluster', '=', 'med_program.FK_kluster') -> 
                                    leftjoin('med_subkluster', 'med_subkluster.id_subkluster', '=', 'med_program.FK_subkluster') -> 
                                    leftjoin('med_unit', 'med_unit.id_unit', '=', 'med_program.FK_unit') ->
                                    where('med_program.FK_kluster','=',$id)->
                                    get(); // list all data

        if ($med_program)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_program
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_program');
        $nama_program = $request->input('nama_program');
        $tarikh_program = $request->input('tarikh_program');
        $FK_kategori = $request->input('FK_kategori');
        $FK_kluster = $request->input('FK_kluster');
        $FK_subkluster = $request->input('FK_subkluster');
        $FK_kampus = $request->input('FK_kampus');
        $FK_unit = $request->input('FK_unit');
        $updated_by = $request->input('updated_by');

        $med_program_search = med_program::where('nama_program',$nama_program) -> 
                                           where('tarikh_program',$tarikh_program) -> 
                                           where('FK_kategori',$FK_kategori) -> 
                                           where('FK_kluster',$FK_kluster) -> 
                                           where('FK_subkluster',$FK_subkluster) -> 
                                           where('FK_kampus',$FK_kampus) -> 
                                           where('FK_unit',$FK_unit) -> 
                                           first(); 

        if ($med_program_search)    {
            return response()->json([
                'success'=>false,
                'message'=>"Gagal! Data Telah Wujud.",
                'data'=>''
            ],200);
        } else {
            $med_program = med_program::where('id_program',$id) -> update([
                'nama_program' => $nama_program,
                'tarikh_program' => $tarikh_program,
                'FK_kategori' => $FK_kategori,
                'FK_kluster' => $FK_kluster,
                'FK_subkluster' => $FK_subkluster,
                'FK_kampus' => $FK_kampus,
                'FK_unit' => $FK_unit,
                'updated_by' => $updated_by
            ]);
    
            if ($med_program)  {
                return response()->json([
                    'success'=>true,
                    'message'=>"Kemaskini Berjaya!",
                    'data' => $med_program
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
    }

    public function search(Request $request){

        $tahun = $request->input('tahun');
        $FK_kategori = $request->input('FK_kategori');
        $nama_program = $request->input('nama_program');
        $Fk_vip = $request->input('Fk_vip');

        $med_program = med_program::select("*", "med_program.statusrekod AS programstatusrekod") ->
                join('med_kategoriprogram', 'med_kategoriprogram.id_kategoriprogram', '=', 'med_program.FK_kategori') -> 
                join('med_kampus', 'med_kampus.id_kampus', '=', 'med_program.FK_kampus') -> 
                join('med_kluster', 'med_kluster.id_kluster', '=', 'med_program.FK_kluster') -> 
                join('med_subkluster', 'med_subkluster.id_subkluster', '=', 'med_program.FK_subkluster') -> 
                leftjoin('med_unit', 'med_unit.id_unit', '=', 'med_program.FK_unit') ->
                where('YEAR(med_program.tarikh_program)','=',$tahun) ->
                orWhere('med_kategoriprogram.id_kategoriprogram','=',$FK_kategori) ->
                orWhere('med_program.nama_program','LIKE','%'.$nama_program.'%') ->
                orWhere('med_program.FK_vip','LIKE','%'.$Fk_vip.'%') ->
                get(); // list all data
                
                if ($med_program)  {
                    return response()->json([
                        'success'=>true,
                        'message'=>"Kemaskini Berjaya!",
                        'data' => $med_program
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

    public function updateTag(Request $request)    {
        $id = $request->input('id_program');
        $imgText = $request->input('imgText');
        $FK_userss = str_replace(",",";",$request->input('FK_users'));
        $updated_by = $request->input('updated_by');
        $append = $imgText . '","FK_vip":"'.$FK_userss;
        // $med_program = med_program::find($id); 
        $med_program = med_program::select('*')->where('id_program',$id)->first();
        
        $media_path = $med_program->media_path;
        $FK_vip = $med_program->FK_vip;
        $new_media_path = str_replace($imgText, $append, $media_path);

        // $listVIP = explode(";",$FK_vip);
        $vip_new = '';

        $FK_users = explode(";",$FK_userss);
        
        foreach ($FK_users as $val) {

            $cekListVip = med_program::select('*')->where('id_program','=',$id)->where('FK_vip','LIKE','%'.$val.'%')->first();
            if($cekListVip != null){
                if($cekListVip->FK_vip == '') {
                    if($vip_new == '') $vip_new = $val;
                    else $vip_new = $vip_new.';'.$val;
                }
            }else{
                if($vip_new == '') $vip_new = $val;
                else $vip_new = $vip_new.';'.$val;
            }
            
            
        }

        if($FK_vip == '') $FK_vip = $vip_new;
        else $FK_vip = $FK_vip.';'.$vip_new;

        $med_program = med_program::where('id_program',$id) -> update([
            'FK_vip' => $FK_vip,
            'media_path' => $new_media_path,
            'updated_by' => $updated_by
        ]);

        if ($med_program)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_program
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

    public function upload(Request $request, $id)    {
        $fileName = $request->file('file')->getClientOriginalName();
        $fileName = $id . '_' . $fileName;
        $path = 'uploads';
        $destinationPath = public_path($path); // upload path
        $request->file('file')->move($destinationPath, $fileName);
        return;
    }

    public function upload2(Request $request, $id)    {
        
        $updated_by = $request->input('updated_by');
        $media_path = $request->input('file');
        $med_program = med_program::select('*')->where('id_program',$id)->first();
        // $med_program = med_program::find($id); 
        // dd($med_program->media_path);
        // $media_path = $med_program->media_path . $media_path;
        $media_path = $media_path;
        $med_program = med_program::where('id_program',$id) -> update([
            'media_path' => $media_path,
            'updated_by' => $updated_by
        ]);

        if ($med_program)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_program
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
        $id = $request->input('id_program');

        $med_program_search = med_program::where('id_program',$id) -> first(); 

        switch($med_program_search->statusrekod)    {
            case 0: $med_program = med_program::where('id_program',$id) -> update([
                        'statusrekod' => '1',
                    ]);
                    break;
            case 1: $med_program = med_program::where('id_program',$id) -> update([
                        'statusrekod' => '0',
                    ]);
                    break;
        }

        $med_program_search = med_program::where('id_program',$id) -> first(); 

        if ($med_program)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Ubah!",
                'data' => $med_program_search
            ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>"Gagal Ubah!",
                'data'=>''
            ],404);
        }
    }
}
