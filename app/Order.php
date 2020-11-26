<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Order extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'product_id', 'store_id', 'deleted_at', 'bill_id', 'status', 'seller_id', 'quantity', 'refunded', 'link_id', 'created_at', 'country_code', 'purchase_id', 'price', 'sellerdiscount'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function purchase()
    {
        return $this->belongsTo('App\Purchase');
    }

    public function product()
    {
        return $this->belongsTo('App\Product')->withTrashed();
    }

    /*public function vendor()
    {
        return $this->belongsTo('App\Vendor');
    }*/
    public function link()
    {
        return $this->belongsTo('App\Link');
    }

    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    public function seller()
    {
        return $this->belongsTo('App\Seller');
    }

    public function scopeSubday($query, $day)
    {
        return $query->whereDate('orders.created_at', Carbon::now()->subDays($day)->format('Y-m-d'));
    }

    public function getProductPrice()
    {
        $discountProducts = OnlineDiscount::pluck('product_id')->toArray();
        $priceType = $this->product->productPrices();
        if (in_array($this->product->id , $discountProducts)) {
            $onlineDiscount = OnlineDiscount::where('product_id' , $this->product->id)->first();
            $price =  $onlineDiscount->discount;
        }else {
            $price = $priceType ;
        }
        return $price ;
    }

/*
    public function getProductPrice($request)
    {
        if (isset($request->country)) {
            if ($request->country == 'EG' || $request->country == 'SA') {
                if ($request->country == $this->product->country_code) {
                    if (isset($this->product->local_discount) && $this->product->local_discount != 0) {
                        $price = explode(' ', $this->product->local_discount);
                        $local_discount_without_currency = json_decode($price[0]);
                        return $local_discount_without_currency;
                    } else {
                        $price = explode(' ', $this->product->local_price);
                        $local_price_without_currency = json_decode($price[0]);
                        return $local_price_without_currency;
                    }
                } else {
                    if (isset($this->product->discount) && $this->product->discount != 0) {
                        $price = explode(' ', $this->product->discount);
                        $discount_without_currency = json_decode($price[0]);
                        return $discount_without_currency;
                    } else {
                        $price = explode(' ', $this->product->price);
                        $price_without_currency = json_decode($price[0]);
                        return $price_without_currency;
                    }
                }
            } else {
                if (isset($this->product->discount) && $this->product->discount != 0) {
                    $price = explode(' ', $this->product->discount);
                    $discount_without_currency = json_decode($price[0]);
                    return $discount_without_currency;
                } else {
                    $price = explode(' ', $this->product->price);
                    $price_without_currency = json_decode($price[0]);
                    return $price_without_currency;
                }
            }
        } else {
            if (isset($this->product->discount) && $this->product->discount != 0) {
                $price = explode(' ', $this->product->discount);
                $discount_without_currency = json_decode($price[0]);
                return $discount_without_currency;
            } else {
                $price = explode(' ', $this->product->price);
                $price_without_currency = json_decode($price[0]);
                return $price_without_currency;
            }
        }
    }
*/
    // public function getCreatedAtAttribute($date)
    // {
    //
    //     return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y/m/d, H:i');
    // }
    //
    // public function getUpdatedAtAttribute($date)
    // {
    //     return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y/m/d, H:i');
    // }

}
