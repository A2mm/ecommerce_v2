<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class Currency extends Model
{

	protected $fillable = ['name', 'arabic_name'];


	public function products(){
      return $this->hasMany('App\Product');
  }

	public function countries(){
      return $this->hasMany('App\Country');
  }

}
