<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class med_permohonan extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $dates = ['tarikh_pengesahan', 'tarikh_luput'];

    protected $table = 'med_permohonan';
    protected $fillable = [
        'id_permohonan', 'FK_users', 'sebab', 'media_list', 'FK_program', 'status_permohonan', 'tarikh_permohonan', 'tarikh_pengesahan', 'tarikh_luput', 'pegawai_pelulus', 'created_by', 'updated_by', 'statusrekod'
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
