<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'doctors_tbl';

    public $timestamps = false;

    public static function firestoreCollection()
    {
        $firestore = app('firebase.firestore');
        $doctors = $firestore->database()->collection('Doctors');
        return $doctors;
    }

    public function getFirestoreIdAttribute()
    {
        $doctors = self::firestoreCollection();

        $user = $doctors->where("email", '=', $this->email)->documents();
        $user_id = "";
        foreach ($user as $value) {
            $user_id = $value->id();
        }

        return $user_id;
    }
}
