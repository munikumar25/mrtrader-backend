<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
class User extends Model
{
    use HasFactory, HasApiTokens;
    public $timeStamps = false;
    protected $fillable = ['id','user_id', 'first_name', 'last_name', 'email', 'password', 'mobile_no', 'gender', 'trade_account', 'unique_code','role','verification_status','user_status'];

    protected $hidden = [
        'password', 'remember_token'
    ];
}
