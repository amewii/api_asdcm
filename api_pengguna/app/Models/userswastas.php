<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class userswastas extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'FK_users', 'FK_kategori_pengguna', 'jawatan', 'alamat1_rumah', 'alamat2_rumah', 'poskod_rumah', 'daerah_rumah', 'negeri_rumah', 'negara_rumah',
        'organisasi', 'alamat1_organisasi', 'alamat2_organisasi', 'poskod_organisasi', 'daerah_organisasi', 'negeri_organisasi',
        'nama_majikan', 'notel_majikan', 'emel_majikan', 'statusrekod'
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
