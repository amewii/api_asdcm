<?php

namespace App\Http\Controllers;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\users;

require './api_media/vendor/autoload.php';

class usersController extends Controller
{
    public function register(Request $request) {
        $nama = $request->input('nama');
        $emel = $request->input('emel');
        $no_kad_pengenalan = $request->input('no_kad_pengenalan');
        $katalaluan = $request->input('katalaluan');
        $notel = $request->input('notel');
        $tarikh_lahir = $request->input('tarikh_lahir');
        $FK_jenis_pengguna = $request->input('FK_jenis_pengguna');
        $FK_gelaran = $request->input('FK_gelaran');
        $FK_negara_lahir = $request->input('FK_negara_lahir');
        $FK_negeri_lahir = $request->input('FK_negeri_lahir');
        $FK_jantina = $request->input('FK_jantina');
        $FK_warganegara = $request->input('FK_warganegara');
        $FK_bangsa = $request->input('FK_bangsa');
        $FK_etnik = $request->input('FK_etnik');
        $FK_agama = $request->input('FK_agama');

        $salt = "RMY7nZ3+s8xpU1n0O*0o_EGfdoYtd|iU_AzhKCMoSu_xhh-e|~y8FOG*-xLZ";
        $enc_katalaluan     = hash("sha256", $katalaluan.$salt);

        $register = users::create([
            'nama' => $nama,
            'emel' => $emel,
            'no_kad_pengenalan' => $no_kad_pengenalan,
            'katalaluan' => $enc_katalaluan,
            'notel' => $notel,
            'tarikh_lahir' => $tarikh_lahir,
            'FK_jenis_pengguna' => $FK_jenis_pengguna,
            'FK_gelaran' => $FK_gelaran,
            'FK_negara_lahir' => $FK_negara_lahir,
            'FK_negeri_lahir' => $FK_negeri_lahir,
            'FK_jantina' => $FK_jantina,
            'FK_warganegara' => $FK_warganegara,
            'FK_bangsa' => $FK_bangsa,
            'FK_etnik' => $FK_etnik,
            'FK_agama' => $FK_agama,
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

    public function resetpassword(Request $request)  {
        $mail = new PHPMailer(true);
        $no_kad_pengenalan = $request->input('no_kad_pengenalan');
        $katalaluan = $request->input('katalaluan');

        $users = users::where('no_kad_pengenalan',$no_kad_pengenalan)->first();
        // dd($users);
        $salt = "RMY7nZ3+s8xpU1n0O*0o_EGfdoYtd|iU_AzhKCMoSu_xhh-e|~y8FOG*-xLZ";
        $enc_katalaluan     = hash("sha256", $katalaluan.$salt);

        $users -> update([
            'katalaluan' => $enc_katalaluan
        ]);

        if ($users)   {
            try {
                $mail->SMTPDebug = 2;                                       
                $mail->isSMTP();                                            
                $mail->Host       = 'mail.protigatech.com;';                    
                $mail->SMTPAuth   = true;                             
                $mail->Username   = 'muhammadamri@protigatech.com;';                 
                $mail->Password   = 'Amewii-0123';                        
                $mail->SMTPSecure = 'tls';                              
                $mail->Port       = 465;  
              
                $mail->setFrom('muhammadamri@protigatech.com', 'Amri Sender');           
                $mail->addAddress('amriamewii@gmail.com', 'Amri Receiver');
                   
                $mail->isHTML(true);                                  
                $mail->Subject = 'ASDCM';
                $mail->Body    = '<b>Set Semula Katalaluan</b> ';
                $mail->AltBody = 'Alternate Message';
                $mail->send();
                // echo "Mail has been sent successfully!";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>''
            ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>"No Data!",
                'data'=>''
            ]);
        }
    }

    public function show(Request $request)  {
        $no_kad_pengenalan = $request->input('no_kad_pengenalan');

        $users = users::where('no_kad_pengenalan',$no_kad_pengenalan)->first();

        if ($users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$users
            ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>"No Data!",
                'data'=>''
            ]);
        }
    }

    public function showIcEmel(Request $request)  {
        $no_kad_pengenalan = $request->input('no_kad_pengenalan');
        $emel = $request->input('emel');

        $users = users::where('no_kad_pengenalan',$no_kad_pengenalan)->where('emel',$emel)->first();

        if ($users)   {
            $mail = new PHPMailer(true);
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$users
            ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>"No Data!",
                'data'=>''
            ]);
        }
    }

    public function showGetIc($no_kad_pengenalan)  {

        $users = users::where('no_kad_pengenalan',$no_kad_pengenalan)->first();

        if ($users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$users
            ],200);
        }
        else{
            return response()->json([
                'success'=>false,
                'message'=>"No Data!",
                'data'=>''
            ]);
        }
    }

    public function list()  {
        $users = users::select("*", "users.id AS PK") ->
                        join('jenispenggunas', 'jenispenggunas.id', '=', 'users.FK_jenis_pengguna') -> 
                        join('gelarans', 'gelarans.id', '=', 'users.FK_gelaran') -> 
                        join('negaras', 'negaras.id', '=', 'users.FK_negara_lahir') -> 
                        join('negeris', 'negeris.id', '=', 'users.FK_negeri_lahir') -> 
                        join('jantinas', 'jantinas.id', '=', 'users.FK_jantina') -> 
                        join('warganegaras', 'warganegaras.id', '=', 'users.FK_warganegara') -> 
                        join('bangsas', 'bangsas.id', '=', 'users.FK_bangsa') -> 
                        join('etniks', 'etniks.id', '=', 'users.FK_bangsa') -> 
                        join('agamas', 'agamas.id', '=', 'users.FK_agama') -> get();

        if ($users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$users
            ],200);
        }
        
    }

    public function listIntan()  {
        $users = users::select("*", "users.id AS PK") ->
                        join('jenispenggunas', 'jenispenggunas.id', '=', 'users.FK_jenis_pengguna') -> 
                        join('usersgovs', 'usersgovs.FK_users', '=', 'users.id') -> 
                        where('users_intan','1') ->
                        get();

        if ($users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$users
            ],200);
        }
        
    }

    public function listIntanGetIc($no_kad_pengenalan)  {
        $users = users::select("*", "users.id AS PK") ->
                        join('jenispenggunas', 'jenispenggunas.id', '=', 'users.FK_jenis_pengguna') -> 
                        join('usersgovs', 'usersgovs.FK_users', '=', 'users.id') -> 
                        where('users_intan','1') -> where('users.no_kad_pengenalan',$no_kad_pengenalan) ->
                        first();

        if ($users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$users
            ],200);
        }
        
    }

    public function listLuar()  {
        $users = users::select("*", "users.id AS PK") ->
                        join('jenispenggunas', 'jenispenggunas.id', '=', 'users.FK_jenis_pengguna') -> 
                        join('gelarans', 'gelarans.id', '=', 'users.FK_gelaran') -> 
                        join('negaras', 'negaras.id', '=', 'users.FK_negara_lahir') -> 
                        join('negeris', 'negeris.id', '=', 'users.FK_negeri_lahir') -> 
                        join('jantinas', 'jantinas.id', '=', 'users.FK_jantina') -> 
                        join('warganegaras', 'warganegaras.id', '=', 'users.FK_warganegara') -> 
                        join('bangsas', 'bangsas.id', '=', 'users.FK_bangsa') -> 
                        join('etniks', 'etniks.id', '=', 'users.FK_bangsa') -> 
                        join('agamas', 'agamas.id', '=', 'users.FK_agama') -> 
                        where('users_intan','0') ->
                        get();

        if ($users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$users
            ],200);
        }
        
    }

    public function listKerajaan()  {
        $users = users::join('jenispenggunas', 'jenispenggunas.id', '=', 'users.FK_jenis_pengguna') -> 
                        join('gelarans', 'gelarans.id', '=', 'users.FK_gelaran') -> 
                        join('negaras', 'negaras.id', '=', 'users.FK_negara_lahir') -> 
                        join('negeris', 'negeris.id', '=', 'users.FK_negeri_lahir') -> 
                        join('jantinas', 'jantinas.id', '=', 'users.FK_jantina') -> 
                        join('warganegaras', 'warganegaras.id', '=', 'users.FK_warganegara') -> 
                        join('bangsas', 'bangsas.id', '=', 'users.FK_bangsa') -> 
                        join('etniks', 'etniks.id', '=', 'users.FK_bangsa') -> 
                        join('agamas', 'agamas.id', '=', 'users.FK_agama') -> 
                        where('FK_jenis_pengguna','1') ->
                        get();

        if ($users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$users
            ],200);
        }
        
    }

    public function listSwasta()  {
        $users = users::join('jenispenggunas', 'jenispenggunas.id', '=', 'users.FK_jenis_pengguna') -> 
                        join('gelarans', 'gelarans.id', '=', 'users.FK_gelaran') -> 
                        join('negaras', 'negaras.id', '=', 'users.FK_negara_lahir') -> 
                        join('negeris', 'negeris.id', '=', 'users.FK_negeri_lahir') -> 
                        join('jantinas', 'jantinas.id', '=', 'users.FK_jantina') -> 
                        join('warganegaras', 'warganegaras.id', '=', 'users.FK_warganegara') -> 
                        join('bangsas', 'bangsas.id', '=', 'users.FK_bangsa') -> 
                        join('etniks', 'etniks.id', '=', 'users.FK_bangsa') -> 
                        join('agamas', 'agamas.id', '=', 'users.FK_agama') -> 
                        where('FK_jenis_pengguna','2') ->
                        get();

        if ($users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$users
            ],200);
        }
        
    }

    public function listPelajar()  {
        $users = users::join('jenispenggunas', 'jenispenggunas.id', '=', 'users.FK_jenis_pengguna') -> 
                        join('gelarans', 'gelarans.id', '=', 'users.FK_gelaran') -> 
                        join('negaras', 'negaras.id', '=', 'users.FK_negara_lahir') -> 
                        join('negeris', 'negeris.id', '=', 'users.FK_negeri_lahir') -> 
                        join('jantinas', 'jantinas.id', '=', 'users.FK_jantina') -> 
                        join('warganegaras', 'warganegaras.id', '=', 'users.FK_warganegara') -> 
                        join('bangsas', 'bangsas.id', '=', 'users.FK_bangsa') -> 
                        join('etniks', 'etniks.id', '=', 'users.FK_bangsa') -> 
                        join('agamas', 'agamas.id', '=', 'users.FK_agama') -> 
                        where('FK_jenis_pengguna','3') ->
                        get();

        if ($users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$users
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id');
        $nama = $request->input('nama');
        $emel = $request->input('emel');
        $no_kad_pengenalan = $request->input('no_kad_pengenalan');
        $notel = $request->input('notel');
        $tarikh_lahir = $request->input('tarikh_lahir');
        $FK_jenis_pengguna = $request->input('FK_jenis_pengguna');
        $FK_gelaran = $request->input('FK_gelaran');
        $FK_negara_lahir = $request->input('FK_negara_lahir');
        $FK_negeri_lahir = $request->input('FK_negeri_lahir');
        $FK_jantina = $request->input('FK_jantina');
        $FK_warganegara = $request->input('FK_warganegara');
        $FK_bangsa = $request->input('FK_bangsa');
        $FK_etnik = $request->input('FK_etnik');
        $FK_agama = $request->input('FK_agama');
        $updated_by = $request->input('updated_by');

        $users = users::find($id); 

        $users -> update([
            'nama' => $nama,
            'emel' => $emel,
            'no_kad_pengenalan' => $no_kad_pengenalan,
            'notel' => $notel,
            'tarikh_lahir' => $tarikh_lahir,
            'FK_jenis_pengguna' => $FK_jenis_pengguna,
            'FK_gelaran' => $FK_gelaran,
            'FK_negara_lahir' => $FK_negara_lahir,
            'FK_negeri_lahir' => $FK_negeri_lahir,
            'FK_jantina' => $FK_jantina,
            'FK_warganegara' => $FK_warganegara,
            'FK_bangsa' => $FK_bangsa,
            'FK_etnik' => $FK_etnik,
            'FK_agama' => $FK_agama,
            'updated_by' => $updated_by
        ]);

        if ($users)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $users
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

        $users = users::find($id); 
        
        $users -> update([
            'statusrekod' => '0',
        ]);

        if ($users)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $users
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
