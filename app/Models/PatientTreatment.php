<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientTreatment extends Model
{
    use SoftDeletes;

    protected $table = 'patient_treatments';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
