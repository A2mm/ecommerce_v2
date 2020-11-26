<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BanneringType extends Model
{
	use SoftDeletes;

	 protected $table = 'bannering_types';
	
    protected $fillable = ['name'];

    public function bannerings()
    {
      return $this->hasMany('App\Bannering');
    }
}
