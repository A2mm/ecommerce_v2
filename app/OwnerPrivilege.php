<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OwnerPrivilege extends Model
{
  protected $fillable = ['privilege','user_id','name','email'];
}
