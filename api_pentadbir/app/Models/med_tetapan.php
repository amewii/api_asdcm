<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class med_tetapan extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'med_tetapan';
    protected $fillable = [
        'id_tetapan', 'nama_sistem', 'versi_sistem', 'pelepasan_sistem', 'status_sistem', 
        'min_katalaluan', 'polisi_katalaluan', 'active_until', 'mail_gateway', 'mail_username', 
        'mail_password', 'mail_smtp_secure', 'mail_port', 'mail_sender', 'link_sistem', 'created_by', 'updated_by', 'statusrekod'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];
}
