<?php

namespace App;

use Hrshadhin\Userstamps\UserstampsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    use UserstampsTrait;

    protected $dates = [
        'event_time',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'event_time',
        'title',
        'description',
        'cover_photo',
        'cover_video',
        'location',
        'slider_1',
        'slider_2',
        'slider_3',
        'slug',
    ];
}