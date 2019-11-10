<?php

namespace App;

use Hrshadhin\Userstamps\UserstampsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IClass extends Model
{
    use SoftDeletes;
    use UserstampsTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'numeric_value',
        'order',
        'group',
        'idYear',
        'idSemester',
        'idSubject',
        'idPhase',
        'status',
        'note',
    ];

    public function section()
    {
        return $this->hasMany('App\Section', 'class_id');
    }

    public function student()
    {
        return $this->hasMany('App\Registration', 'class_id');
    }

    public function attendance()
    {
        return $this->hasMany('App\StudentAttendance', 'class_id');
    }
}