<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PatientTest extends Model
{

    use SoftDeletes;

    protected $table = 'patient_tests';
    protected $guarded = ["patient_test_id"];
    protected $primaryKey = "patient_test_id";
}
