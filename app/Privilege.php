<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
  protected $fillable = ['privilege','user_id'];
}
