<?php

namespace App;

use Hrshadhin\Userstamps\UserstampsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

class AcademicYear extends Model
{
    use SoftDeletes;
    use UserstampsTrait;

    protected $dates = ['start_date', 'end_date'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'yearId', 'start_date', 'end_date', 'status'];

}