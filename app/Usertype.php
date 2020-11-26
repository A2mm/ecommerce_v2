<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Usertype extends Model
{
    protected $fillable = ['name', 'description'];

    public function users()
    {
    	return $this->hasMany(User::class);
    }
}

