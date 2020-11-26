<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PasswordReset extends Model
{
	protected $fillable = ['id','user_id','code','expiry_time'];
	protected $dates = ['expiry_time'];


   public function scopeRunning($query){
   	$now = Carbon::now();
   	return $query->where('expiry_time', '>', $now);
   }

}