<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\logs;

class logsController extends Controller
{
    public function register(Request $request) {
        $FK_users = $request->input('FK_users');
        $action_made = $request->input('action_made');
        $browser_name = $request->input('browser_name');

        $register = logs::create([
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

        $logs = logs::where('FK_users',$FK_users)->get();

        if ($logs)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$logs
            ],201);
        }
    }

    public function list()  {
        $logs = logs::select("*", "logs.id AS PK", "logs.created_at AS logsTime") -> 
                    join('users', 'users.id', '=', 'logs.FK_users') -> 
                    orderBy('logs.id', 'desc') ->
                    get(); // list all data // list all data

        if ($logs)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$logs
            ],200);
        }
        
    }
}
