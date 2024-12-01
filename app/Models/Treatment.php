<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Treatment extends Model
{
    use SoftDeletes;

    protected $table = 'treatments';
    protected $guarded = ['id'];
    protected $primaryKey = "id";
}
