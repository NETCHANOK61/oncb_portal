<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolDepartment extends Model
{
    use HasFactory;
    protected $table = 'TblSchoolDepartment';
    protected $guarded = [];
}
