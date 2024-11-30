<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientRecord extends Model
{
    use softDeletes;

    protected $table = 'patient_records';
    protected $guarded = ["patient_record_id"];
    protected $primaryKey = "patient_record_id";
}
