<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_sysposkod;

class med_sysposkodController extends Controller
{
    public function show(Request $request, $poskod)  {
        // $poskod = $request->input('poskod');

        $med_sysposkod = med_sysposkod::join('med_sys_negeri', 'med_sys_negeri.id_sys_negeri', '=', 'med_sysposkod.negeri') -> 
                                where('poskod',$poskod)->first();

        if ($med_sysposkod)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_sysposkod
            ],201);
        }
    }

    public function list()  {
        $med_sysposkod = med_sysposkod::join('med_sys_negeri', 'med_sys_negeri.id_sys_negeri', '=', 'med_sysposkod.negeri') -> 
                                where('statusrekod','1') -> get(); // list all data

        if ($med_sysposkod)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Berjaya!',
                'data'=>$med_sysposkod
            ],200);
        }
        
    }
}
