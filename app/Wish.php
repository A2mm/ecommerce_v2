<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wish extends Model
{
    use SoftDeletes;

    protected $table = 'wishs';
    protected $fillable = ['user_id','product_id'];

    public function user(){
      return $this->belongsTo('App\User');
    }


     public function product(){
      return $this->belongsTo('App\Product');
    }


}
