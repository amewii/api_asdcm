<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class userspelajars extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'FK_users', 'FK_kategori_pengguna', 'alamat1_rumah', 'alamat2_rumah', 'poskod_rumah', 'daerah_rumah', 'negeri_rumah', 'negara_rumah',
        'nama_sekolah', 'alamat1_sekolah', 'alamat2_sekolah', 'poskod_sekolah', 'daerah_sekolah', 'negeri_sekolah', 'statusrekod'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'katalaluan',
    ];
}
