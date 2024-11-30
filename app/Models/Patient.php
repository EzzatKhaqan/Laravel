<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use softDeletes;
    protected $table = 'patients';
    protected $fillable = ['firstname','lastname','gender','address','phone','DOB'];

    protected $primaryKey = "patient_id";
}
