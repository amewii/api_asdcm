<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class usersgovs extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'FK_users', 'FK_kategori_pengguna', 'kod_jawatan', 'nama_jawatan', 'kategori_perkhidmatan', 
        'skim', 'gred', 'taraf_jawatan', 'jenis_perkhidmatan', 'tarikh_lantikan', 'unit_organisasi', 'gred', 
        'users_intan', 'FK_kampus', 'FK_kluster', 'FK_subkluster', 'FK_unit', 'FK_kementerian', 'FK_agensi', 
        'FK_bahagian', 'FK_ila', 'alamat1_pejabat', 'alamat2_pejabat', 'poskod_pejabat', 'bandar_pejabat', 
        'negeri_pejabat', 'created_by', 'updated_by', 'statusrekod'
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
