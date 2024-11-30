<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientMedicine extends Model
{

    use softDeletes;

    protected $table = 'patient_medicines';
    protected $guarded = ["patient_medicine_id"];
    protected $primaryKey = "patient_medicine_id";
}
