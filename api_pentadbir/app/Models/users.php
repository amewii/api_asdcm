<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class users extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nama', 'emel', 'no_kad_pengenalan', 'katalaluan', 'notel', 'tarikh_lahir', 'FK_jenis_pengguna', 'FK_gelaran',
        'FK_negara_lahir', 'FK_negeri_lahir', 'FK_jantina', 'FK_warganegara', 'FK_bangsa', 'FK_etnik', 'FK_agama', 'statusrekod'
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
