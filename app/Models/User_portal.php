<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_portal extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_2';

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'card_id',
        'file',
        'username',
        'surname',
        'userid',
        'agency',
        'PROV_ID',
        'AMP_ID',
        'edu_area_id'
    ];
}
