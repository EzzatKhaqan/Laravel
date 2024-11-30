<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class staff extends Model
{
    use softDeletes;
    protected $table = 'staff';
    protected $guarded = ['staff_id'];
    protected $primaryKey = "staff_id";

}
