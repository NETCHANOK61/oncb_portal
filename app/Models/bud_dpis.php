<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class  bud_dpis extends Model
{
    use HasFactory;

    protected $table = "tblbud_dpis";
    protected $primaryKey = 'per_id';
}
