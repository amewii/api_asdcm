<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_log;

class med_logController extends Controller
{
    public function register(Request $request) {
        $FK_users = $request->input('FK_users');
        $action_made = $request->input('action_made');
        $browser_name = getHostByName(getHostName());

        $register = med_log::create([
            'FK_users' => $FK_users,
            'action_made' => $action_made,
            'browser_name' => $browser_name
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
                'message'=>'Gagal Daftar Maklumat',
                'data'=>$register
            ],405);
        }
    }

    public function show(Request $request)  {
        $FK_users = $request->input('FK_users');

        $med_log = med_log::where('FK_users',$FK_users)->get();

        if ($med_log)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_log
            ],201);
        }
    }

    public function list()  {
        $med_log = med_log::select("*", "med_log.id_log AS PK", med_log::raw("DATE_FORMAT(med_log.created_at,'%d/%m/%Y %h:%i:%s') AS logsTime")) -> 
                    join('med_users', 'med_users.id_users', '=', 'med_log.FK_users') -> 
                    orderBy('med_log.id_log', 'desc') ->
                    get(); // list all data // list all data

        if ($med_log)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_log
            ],200);
        }
        
    }
}
