<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  protected $table = 'carts';
	protected $fillable = ['product_id','vendor_id','store_id','quantity','reason'];
}
