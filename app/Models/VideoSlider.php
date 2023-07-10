<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoSlider extends Model
{
    use HasFactory;

    protected $table = 'videos_slider_tbl';

    public $timestamps = false;
}
