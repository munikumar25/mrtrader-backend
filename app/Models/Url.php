<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;
    public $timeStamps = false;
    protected $fillable = ['id', 'url', 'type','url_parent_id'];
}
