<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model {
    protected $fillable = ['user_id','patient_name','phone','date_of_birth','gender','address','blood_group','weight','blood_pressure','blood_sugar'];

    public function user() { return $this->belongsTo(User::class); }
    public function appointments() { return $this->hasMany(Appointment::class); }
    public function prescriptions() { return $this->hasMany(Prescription::class); }
}