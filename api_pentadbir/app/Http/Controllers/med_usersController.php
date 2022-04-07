<?php

namespace App\Http\Controllers;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\med_users;

// require '../api_pentadbir/vendor/autoload.php';

class med_usersController extends Controller
{
    public function register(Request $request) {
        $nama = $request->input('nama');
        $emel = $request->input('emel');
        $no_kad_pengenalan = $request->input('no_kad_pengenalan');
        $katalaluan = $request->input('katalaluan');
        $notel = $request->input('notel');
        $FK_jenis_pengguna = $request->input('FK_jenis_pengguna');
        $FK_gelaran = $request->input('FK_gelaran');

        $salt = "RMY7nZ3+s8xpU1n0O*0o_EGfdoYtd|iU_AzhKCMoSu_xhh-e|~y8FOG*-xLZ";
        $enc_katalaluan     = hash("sha256", $katalaluan.$salt);

        $register = med_users::create([
            'nama' => $nama,
            'emel' => $emel,
            'no_kad_pengenalan' => $no_kad_pengenalan,
            'katalaluan' => $enc_katalaluan,
            'notel' => $notel,
            'FK_jenis_pengguna' => $FK_jenis_pengguna,
            'FK_gelaran' => $FK_gelaran,
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
        $no_kad_pengenalan = $request->input('no_kad_pengenalan');
        $katalaluan = $request->input('katalaluan');

        $med_users = med_users::where('no_kad_pengenalan',$no_kad_pengenalan)->first();
        $salt = "RMY7nZ3+s8xpU1n0O*0o_EGfdoYtd|iU_AzhKCMoSu_xhh-e|~y8FOG*-xLZ";
        $enc_katalaluan     = hash("sha256", $katalaluan.$salt);
        
        $med_users -> update([
            'katalaluan' => $enc_katalaluan
        ]);

        if ($med_users)   {
            $emel = $med_users->emel;
            $mail = new PHPMailer();
        // mail('amriamewii@gmail.com', '[TEST MESSAGE]', 'This is the body message', 'From: muhammadamri@protigatech.com');
            $mail->SMTPDebug = 0;                                       
            $mail->isSMTP();                                            
            $mail->Host       = 'mail.protigatech.com';                    
            // $mail->SMTPAuth   = true;                             
            $mail->Username   = 'muhammadamri@protigatech.com';                 
            $mail->Password   = 'muhammadamri@protigatech.com';                        
            $mail->SMTPSecure = 'ssl';                              
            $mail->Port       = 465;  
            
            $mail->setFrom('muhammadamri@protigatech.com', 'ASDCM Technical Team');           
            $mail->addAddress($emel);
                
            $mail->isHTML(true);                                  
            $mail->Subject = 'PENGURUSAN MEDIA';
            $mail->Body    = '<b>Set Semula Katalaluan</b><br><br>Katalaluan anda telah disetsemula. Sila gunakan katalaluan baharu untuk log ke dalam sistem. Terima kasih.';
            $mail->AltBody = 'Alternate Message';
            if(!$mail->send()) {
                dd("Mailer Error: " . $mail->ErrorInfo);
                exit;
            }
            if(!$mail->send()) {
                dd("Mailer Error: " . $mail->ErrorInfo);
            } 
            else {
                dd("Message has been sent successfully");
            }
            // dd($mail->send());
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

        $med_users = med_users::where('no_kad_pengenalan',$no_kad_pengenalan)->first();

        if ($med_users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_users
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

        $med_users = med_users::where('no_kad_pengenalan',$no_kad_pengenalan)->where('emel',$emel)->first();

        if ($med_users)   {
            $mail = new PHPMailer(true);
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_users
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

        $med_users = med_users::where('no_kad_pengenalan',$no_kad_pengenalan)->first();

        if ($med_users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'Show Success!',
                'data'=>$med_users
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
        $med_users = med_users::join('med_jenispengguna', 'med_jenispengguna.id_jenispengguna', '=', 'med_users.FK_jenis_pengguna') -> 
                                join('med_gelaran', 'med_gelaran.id_gelaran', '=', 'med_users.FK_gelaran') -> get();

        if ($med_users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_users
            ],200);
        }
        
    }

    public function listIntan()  {
        $med_users = med_users::join('med_jenispengguna', 'med_jenispengguna.id_jenispengguna', '=', 'med_users.FK_jenis_pengguna') -> 
                                join('med_usersgov', 'med_usersgov.FK_users', '=', 'med_users.id_users') -> 
                                where('users_intan','1') ->
                                get();

        if ($med_users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_users
            ],200);
        }
        
    }

    public function listIntanGetIc($no_kad_pengenalan)  {
        $med_users = med_users::join('med_jenispengguna', 'med_jenispengguna.id_jenispengguna', '=', 'med_users.FK_jenis_pengguna') -> 
                                join('med_usersgov', 'med_usersgov.FK_users', '=', 'med_users.id_users') -> 
                                where('users_intan','1') -> where('med_users.no_kad_pengenalan',$no_kad_pengenalan) ->
                                first();

        if ($med_users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_users
            ],200);
        }
        
    }

    public function listLuar()  {
        $med_users = med_users::join('med_jenispengguna', 'med_jenispengguna.id_jenispengguna', '=', 'med_users.FK_jenis_pengguna') -> 
                                join('med_gelaran', 'med_gelaran.id_gelaran', '=', 'med_users.FK_gelaran') -> 
                                where('users_intan','0') ->
                                get();

        if ($med_users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_users
            ],200);
        }
        
    }

    public function listAll()  {
        $med_users = med_users::join('med_jenispengguna', 'med_jenispengguna.id_jenispengguna', '=', 'med_users.FK_jenis_pengguna') -> 
                                join('med_gelaran', 'med_gelaran.id_gelaran', '=', 'med_users.FK_gelaran') -> 
                                leftjoin('med_capaian', 'med_capaian.FK_users', '=', 'med_users.id_users') -> 
                                leftjoin('med_peranan', 'med_peranan.id_peranan', '=', 'med_capaian.FK_peranan') -> 
                                orderby(med_users::raw('ISNULL(med_peranan.id_peranan)', 'ASC')) -> orderby('med_peranan.id_peranan', 'ASC') ->
                                get();

        if ($med_users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_users
            ],200);
        }
        
    }

    public function listKerajaan()  {
        $med_users = med_users::join('med_jenispengguna', 'med_jenispengguna.id_jenispengguna', '=', 'med_users.FK_jenis_pengguna') -> 
                                join('med_gelaran', 'med_gelaran.id_gelaran', '=', 'med_users.FK_gelaran') -> 
                                where('FK_jenis_pengguna','1') ->
                                get();

        if ($med_users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_users
            ],200);
        }
        
    }

    public function listKerajaanSingle($FK_users)  {
        $med_users = med_users::join('med_usersgov', 'med_usersgov.FK_users', '=', 'med_users.id_users') -> 
                                leftjoin('med_kampus', 'med_kampus.id_kampus', '=', 'med_usersgov.FK_kampus') -> 
                                leftjoin('med_kluster', 'med_kluster.id_kluster', '=', 'med_usersgov.FK_kluster') -> 
                                leftjoin('med_subkluster', 'med_subkluster.id_subkluster', '=', 'med_usersgov.FK_subkluster') -> 
                                leftjoin('med_unit', 'med_unit.id_unit', '=', 'med_usersgov.FK_unit') -> 
                                leftjoin('med_kementerian', 'med_kementerian.id_kementerian', '=', 'med_usersgov.FK_kementerian') -> 
                                leftjoin('med_agensi', 'med_agensi.id_agensi', '=', 'med_usersgov.FK_agensi') -> 
                                leftjoin('med_bahagian', 'med_bahagian.id_bahagian', '=', 'med_usersgov.FK_bahagian') -> 
                                leftjoin('med_ilawam', 'med_ilawam.id_ilawam', '=', 'med_usersgov.FK_ila') -> 
                                where('FK_jenis_pengguna','1') -> where('med_users.id_users',$FK_users) ->
                                first();

        if ($med_users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_users
            ],200);
        }
        
    }

    public function listSwasta()  {
        $med_users = med_users::join('med_jenispengguna', 'med_jenispengguna.id_jenispengguna', '=', 'med_users.FK_jenis_pengguna') -> 
                                join('med_gelaran', 'med_gelaran.id_gelaran', '=', 'med_users.FK_gelaran') -> 
                                where('FK_jenis_pengguna','2') ->
                                get();

        if ($med_users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_users
            ],200);
        }
        
    }

    public function listPelajar()  {
        $med_users = med_users::join('med_jenispengguna', 'med_jenispengguna.id_jenispengguna', '=', 'med_users.FK_jenis_pengguna') -> 
                                join('med_gelaran', 'med_gelaran.id_gelaran', '=', 'med_users.FK_gelaran') -> 
                                where('FK_jenis_pengguna','3') ->
                                get();

        if ($med_users)   {
            return response()->json([
                'success'=>'true',
                'message'=>'List Success!',
                'data'=>$med_users
            ],200);
        }
        
    }

    public function update(Request $request)    {
        $id = $request->input('id_users');
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

        $med_users = med_users::find($id); 

        $med_users -> update([
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

        if ($med_users)  {
            return response()->json([
                'success'=>true,
                'message'=>"Kemaskini Berjaya!",
                'data' => $med_users
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
        $id = $request->input('id_users');

        $med_users = med_users::find($id); 
        
        $med_users -> update([
            'statusrekod' => '0',
        ]);

        if ($med_users)  {
            return response()->json([
                'success'=>true,
                'message'=>"Berjaya Padam!",
                'data' => $med_users
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

    function sendmail($to, $nameto, $subject, $message, $altmess) {
        echo $subject;
        $from = 'muhammadamri@protigatech.com';
        $namefrom = 'Amri';
        $mail = new PHPMailer();
        $mail->SMTPDebug = 0;
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();
        $mail->SMTPAuth = true;
        $mail->Host = "mail.protigatech.com";
        $mail->Port = 465;
        $mail->Username = $from;
        $mail->Password = 'Amewii-0123';
        $mail->SMTPSecure = "ssl";
        $mail->setFrom($from, $namefrom);
        $mail->addCC($from, $namefrom);
        $mail->Subject = $subject;
        $mail->isHTML();
        $mail->Body = $message;
        $mail->AltBody = $altmess;
        $mail->addAddress($to, $nameto);
        return $mail->send();
    }
    
}
