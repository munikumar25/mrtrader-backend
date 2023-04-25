<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $fillable = ['video_id', 'video_name', 'video_discription', 'url', 'video_thumbnail','category', 'video_status', 'access'];
}
