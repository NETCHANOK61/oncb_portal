<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_nispa extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_2';

    protected $table = 'requested_user';

    protected $fillable = [
        'name',
        'surname',
        'phone',
        'email',
        'card_id',
        'agency',
        'PROV_ID',
        'AMP_ID',
        'edu_area_id',
        'file',
        'userid'
    ];
}
