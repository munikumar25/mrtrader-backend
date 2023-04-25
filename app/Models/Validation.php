<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    use HasFactory;

    public $timeStamps = false;
    protected $fillable = ['vid', 'name','trade_account','code','aadhar','pan'];
}
					