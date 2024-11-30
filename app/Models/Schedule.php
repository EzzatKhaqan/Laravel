<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
    use softDeletes;

    protected  $table = "schedules";
    protected $guarded = ["schedule_id"];
    protected $primaryKey = "schedule_id";
}
