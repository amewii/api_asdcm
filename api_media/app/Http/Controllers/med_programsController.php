<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_programs;

class med_programsController extends Controller
{
    public function register(Request $request) {
        $nama_program = $request->input('nama_program');
        $tarikh_program = $request->input('tarikh_program');
        $FK_kategori = $request->input('FK_kategori');
        $FK_kluster = $request->input('FK_kluster');
        $FK_kampus = $request->input('FK_kampus');
        $FK_unit = $request->input('FK_unit');
        $FK_vip = $request->input('FK_vip');
        $created_by = $request->input('created_by'); // Pakai IC
        $updated_by = $request->input('updated_by'); // Pakai IC
        $statusrekod = $request->input('statusrekod');

        $register = med_programs::create([
            'nama_program' => $nama_program,
            'tarikh_program' => $tarikh_program,
            'FK_kategori' => $FK_kategori,
            'FK_kluster' => $FK_kluster,
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

    public function show(Request $request)  {
        $id = $request->input('id');

        $med_programs = med_programs::select("*", "med_programs.id AS PK") ->
                                        where('id',$id)->first();

        if ($med_programs)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_programs
            ],200);
        }
    }

    public function showGet(Request $request, $id)  {
        // $id = $request->input('id');

        $med_programs = med_programs::select("*", "med_programs.id AS PK") ->
                                        join('med_kategoriprograms', 'med_kategoriprograms.id', '=', 'med_programs.FK_kategori') -> 
                                        join('kampuses', 'kampuses.id', '=', 'med_programs.FK_kampus') -> 
                                        join('negeris', 'negeris.id', '=', 'kampuses.FK_negeri') -> 
                                        join('klusters', 'klusters.id', '=', 'med_programs.FK_kluster') -> 
                                        join('units', 'units.id', '=', 'med_programs.FK_unit') -> 
                                        where('med_programs.id',$id)->first();

        if ($med_programs)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_programs
            ],200);
        }
    }

    public function list()  {
        $med_programs = med_programs::select("*", "med_programs.id AS PK") ->
                                        join('med_kategoriprograms', 'med_kategoriprograms.id', '=', 'med_programs.FK_kategori') -> 
                                        join('kampuses', 'kampuses.id', '=', 'med_programs.FK_kampus') -> 
                                        join('negeris', 'negeris.id', '=', 'kampuses.FK_negeri') -> 
                                        join('klusters', 'klusters.id', '=', 'med_programs.FK_kluster') -> 
                                        join('units', 'units.id', '=', 'med_programs.FK_unit') -> 
                                        where('med_programs.statusrekod','1') -> where('kampuses.statusrekod','1') -> where('klusters.statusrekod','1') -> where('units.statusrekod','1') -> 
                                        get(); // list all data

        if ($med_programs)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_programs
            ],200);
        }
        
    }

    public function listpdf()  {
        $med_programs = med_programs::select("*", "med_programs.id AS PK") ->
                                        join('med_kategoriprograms', 'med_kategoriprograms.id', '=', 'med_programs.FK_kategori') -> 
                                        join('kampuses', 'kampuses.id', '=', 'med_programs.FK_kampus') -> 
                                        join('negeris', 'negeris.id', '=', 'kampuses.FK_negeri') -> 
                                        join('klusters', 'klusters.id', '=', 'med_programs.FK_kluster') -> 
                                        join('units', 'units.id', '=', 'med_programs.FK_unit') -> 
                                        where('med_programs.statusrekod','1') -> where('kampuses.statusrekod','1') -> where('klusters.statusrekod','1') -> where('units.statusrekod','1') -> 
                                        get(); // list all data
        $html = '<html><body>'
			. '<p>Put your html here, or generate it with your favourite '
			. 'templating system.</p>'
			. '</body></html>';
	// return PDF::load($html, 'A4', 'portrait')->show();
        if ($med_programs)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_programs
            ],200);
        }
        
    }

    public function listbergambar()  {
        $med_programs = med_programs::select("*", "med_programs.id AS PK") ->
                                        join('med_kategoriprograms', 'med_kategoriprograms.id', '=', 'med_programs.FK_kategori') -> 
                                        join('kampuses', 'kampuses.id', '=', 'med_programs.FK_kampus') -> 
                                        join('negeris', 'negeris.id', '=', 'kampuses.FK_negeri') -> 
                                        join('klusters', 'klusters.id', '=', 'med_programs.FK_kluster') -> 
                                        join('units', 'units.id', '=', 'med_programs.FK_unit') -> 
                                        where('med_programs.statusrekod','1') -> where('kampuses.statusrekod','1') -> where('klusters.statusrekod','1') -> whereNotNull('media_path') ->
                                        orderBy('tarikh_program', 'desc') ->
                                        get(); // list all data

        if ($med_programs)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_programs
            ],200);
        }
        
    }

    public function listall()  {
        $med_programs = med_programs::select("*", "med_programs.id AS PK", "med_programs.statusrekod AS programstatusrekod") ->
                                        join('med_kategoriprograms', 'med_kategoriprograms.id', '=', 'med_programs.FK_kategori') -> 
                                        join('kampuses', 'kampuses.id', '=', 'med_programs.FK_kampus') -> 
                                        join('negeris', 'negeris.id', '=', 'kampuses.FK_negeri') -> 
                                        join('klusters', 'klusters.id', '=', 'med_programs.FK_kluster') -> 
                                        join('units', 'units.id', '=', 'med_programs.FK_unit') -> 
                                        get(); // list all data

        if ($med_programs)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_programs
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama_program = $request->input('nama_program');
        $tarikh_program = $request->input('tarikh_program');
        $FK_kategori = $request->input('FK_kategori');
        $FK_kluster = $request->input('FK_kluster');
        $FK_kampus = $request->input('FK_kampus');
        $FK_unit = $request->input('FK_unit');
        $updated_by = $request->input('updated_by');

        $med_programs = med_programs::find($id); 

        $med_programs -> update([
            'nama_program' => $nama_program,
            'tarikh_program' => $tarikh_program,
            'FK_kategori' => $FK_kategori,
            'FK_kluster' => $FK_kluster,
            'FK_kampus' => $FK_kampus,
            'FK_unit' => $FK_unit,
            'updated_by' => $updated_by
        ]);

        if ($med_programs)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_programs
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
        $id = $request->input('id');
        $imgText = $request->input('imgText');
        $FK_users = $request->input('FK_users');
        $updated_by = $request->input('updated_by');
        $append = $imgText . '","FK_vip":"'.$FK_users;
        $med_programs = med_programs::find($id); 
        $media_path = $med_programs->media_path;
        $new_media_path = str_replace($imgText, $append, $media_path);

        $med_programs -> update([
            'media_path' => $new_media_path,
            'updated_by' => $updated_by
        ]);

        if ($med_programs)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_programs
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
        $med_programs = med_programs::find($id); 
        // dd($med_programs->media_path);
        // $media_path = $med_programs->media_path . $media_path;
        $media_path = $media_path;
        $med_programs -> update([
            'media_path' => $media_path,
            'updated_by' => $updated_by
        ]);

        if ($med_programs)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_programs
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

        $med_programs = med_programs::find($id); 

        switch($med_programs->statusrekod)    {
            case 0: $med_programs -> update([
                        'statusrekod' => '1',
                    ]);
                    break;
            case 1: $med_programs -> update([
                        'statusrekod' => '0',
                    ]);
                    break;
        }

        if ($med_programs)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_programs
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
