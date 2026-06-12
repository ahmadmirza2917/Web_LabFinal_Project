<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiInteraction extends Model {
    protected $fillable = ['user_id','type','input','response'];
    public function user() { return $this->belongsTo(User::class); }
}