<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trader extends Model
{
    use HasFactory;

    public $timeStamps = false;
    protected $fillable = ['tid', 'trader_name', 'refferal_id'];
}
