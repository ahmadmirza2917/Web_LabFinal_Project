<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model {
    protected $fillable = ['user_id','doctor_name','specialization','phone','consultation_fee','bio','experience','qualification','is_available'];

    public function user() { return $this->belongsTo(User::class); }
    public function appointments() { return $this->hasMany(Appointment::class); }
    public function prescriptions() { return $this->hasMany(Prescription::class); }
}