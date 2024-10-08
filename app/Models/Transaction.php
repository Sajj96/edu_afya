<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'user_doctor_subscriptions_tbl';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getUserNameAttribute()
    {
        if($this->user){
            return $this->user->name;
        }
        return "Unknown";
    }

    public function getUserPhoneAttribute()
    {
        if($this->user){
            return $this->user->phonenumber;
        }
        return "Unknown";
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function getDoctorNameAttribute()
    {
        if($this->doctor){
            return $this->doctor->name;
        }
        return "Unknown";
    }

    public function getIsActiveAttribute()
    {
        $expire_date = date('Y-m-d', strtotime($this->subscription_expire_date));
        if($this->subscription_status == 1 && $expire_date >= date('Y-m-d') ) {
            return true;
        }
        return false;
    }
}
