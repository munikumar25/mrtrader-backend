<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Audio extends Model
{
    use HasFactory;

    protected $fillable = ['audio_id', 'audio_name', 'audio_discription','audio_thumbnail', 'url', 'audio_status', 'access'];
}
