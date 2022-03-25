<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\sysposkod;

class sysposkodController extends Controller
{
    public function show(Request $request, $poskod)  {
        // $poskod = $request->input('poskod');

        $sysposkod = sysposkod::join('sys_negeri', 'sys_negeri.id', '=', 'sysposkod.negeri') -> 
                                where('poskod',$poskod)->first();

        if ($sysposkod)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$sysposkod
            ],201);
        }
    }

    public function list()  {
        $sysposkod = sysposkod::join('sys_negeri', 'sys_negeri.id', '=', 'sysposkod.negeri') -> 
                                where('statusrekod','1') -> get(); // list all data

        if ($sysposkod)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$sysposkod
            ],200);
        }
        
    }
}
