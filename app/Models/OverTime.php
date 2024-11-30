<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OverTime extends Model
{
    use softDeletes;

    protected $guarded = ['id'];

    protected $table = 'over_times';
    protected $primaryKey = 'id';
}
