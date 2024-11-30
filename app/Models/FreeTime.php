<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FreeTime extends Model
{
    use SoftDeletes;

    protected $table = 'free_times';
    protected $guarded = ['id'];
    protected $primaryKey = "id";
}
