<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admit extends Model
{
    use SoftDeletes;

    protected $table = "admits";
    protected $guarded = ['admit_id'];
    protected $primaryKey = "admit_id";
}
