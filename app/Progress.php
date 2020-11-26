<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Store;
use App\Product;
use App\User;

class Progress extends Model
{
    use SoftDeletes;

    protected $table = 'progress';

	protected $fillable = [
	 	'user_id',
        'product_id',
        'order_status',
        'quantity',
        'price',
        'purchase_price',
        'bill_id',
        'purchase_id',
        'store_id',
        'seller_id',
        'payment_method_id',
        'use_promo',
        'shipment',
    ];  

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

     public function store()
    {
        return $this->belongsTo(Store::class);
    }
}



 