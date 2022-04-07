<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_status;

class med_statusController extends Controller
{
    public function register(Request $request)
    {
        $kod_status = $request->input('kod_status');
        $nama_status = $request->input('nama_status');
        $created_by = $request->input('created_by'); // Pakai IC
        $updated_by = $request->input('updated_by'); // Pakai IC
        $statusrekod = $request->input('statusrekod');

        $register = med_status::create([
            'kod_status' => $kod_status,
            'nama_status' => $nama_status,
            'created_by' => $created_by,
            'updated_by' => $updated_by,
            'statusrekod' => $statusrekod
        ]);

        if ($register) {
            return response()->json([
                'success' => 'true',
                'message' => 'Register Success!',
                'data' => $register
            ], 201);
        } else {
            return response()->json([
                'success' => 'false',
                'message' => 'Bad Request',
                'data' => $register
            ], 400);
        }
    }

    public function show(Request $request)
    {
        $id = $request->input('id_status');

        $med_status = med_status::where('id_status', $id)->first();

        if ($med_status) {
            return response()->json([
                'success' => 'true',
                'message' => 'Show Success!',
                'data' => $med_status
            ], 200);
        }
    }

    public function list()
    {
        $med_status = med_status::where('statusrekod', '1')->get();

        if ($med_status) {
            return response()->json([
                'success' => 'true',
                'message' => 'List Success!',
                'data' => $med_status
            ], 200);
        }
    }

    public function listkelulusan()
    {
        $med_status = med_status::where('id_status' < '4')->get();

        if ($med_status) {
            return response()->json([
                'success' => 'true',
                'message' => 'List Success!',
                'data' => $med_status
            ], 200);
        }
    }

    public function update(Request $request)
    {
        $id = $request->input('id_status');
        $kod_status = $request->input('kod_status');
        $nama_status = $request->input('nama_status');
        $updated_by = $request->input('updated_by');

        $med_status_check = med_status::where('nama_status', $nama_status)->first();
        if ($med_status_check) {
            return response()->json([
                'success' => false,
                'message' => "Gagal! Data Telah Wujud",
                'data' => ''
            ], 200);
        } else {
            $med_status = med_status::where('id_status', $id)->update([
                'kod_status' => $kod_status,
                'nama_status' => $nama_status,
                'updated_by' => $updated_by
            ]);

            if ($med_status) {
                return response()->json([
                    'success' => true,
                    'message' => "Berjaya!",
                    'data' => $med_status
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => "Kemaskini Gagal!",
                    'data' => ''
                ], 200);
            }
        }
    }
}
