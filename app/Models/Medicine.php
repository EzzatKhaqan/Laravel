<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medicine extends Model
{
    use softDeletes;

    protected $table = "medicines";

    protected $guarded= ["medicine_id"];

    protected $primaryKey = "medicine_id";
}
