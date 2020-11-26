<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Session;
use Swap;
use App\Seller;
use App\Store;

class Purchase extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'purchaser', 'billing_address', 'delivery_address', 'receptor_mobile', 'buyer_mobile', 'receptor_name', 'price', 'method', 'purchase_status', 'note', 'bill_id', 'shipment','payment_method_id', 'seller_id', 'store_id', 'sellerdiscount' , 'use_promo'];

    public function user()
    {
        return $this->belongsTo('App\User')->withTrashed();
    }

    public function orders()
    {
        return $this->hasMany('App\Order')->withTrashed();
    }


    public function product_store_quantity()
    {
        return $this->hasMany('App\ProductStoreQuantity');
    }


    public function products()
    {
        // return $this->hasManyThrough('App\Product', 'App\Order', 'id', 'id', 'id', 'product_id')->withTrashed();
        $products = [];
        foreach ($this->orders as $key => $order) {
          // foreach ($order->product as $key => $value) {
            $products[] = $order->product;
          // }
        }
        return collect($products);
    }

    public function histories()
    {
        return $this->hasMany('App\History');
    }

    public function getPriceAttribute($value)
    {
    /*    if (request()->c) {
            if ((request()->c == 'GBP')) {
                return $value . ' ' . 'GBP';
            } else {
                $to_Curr = request()->c;
                $rate = Session::get('rate');
                $curr = Session::get('curr');
                if ($rate && $curr) {
                    if ($curr == $to_Curr) {
                        //$exchange_rate = $this->currencyConverter($to_Curr);
                        //$exchange_rate=number_format($exchange_rate, 2, '.', '');
                        return $rate * $value . ' ' . $curr;
                    } else {
                        $exchange_rate = $this->currencyConverter($to_Curr);
                        //$exchange_rate=number_format($exchange_rate, 2, '.', '');
                        return $exchange_rate * $value . ' ' . $to_Curr;
                    }
                } else {
                    $exchange_rate = $this->currencyConverter($to_Curr);
                    //$exchange_rate=number_format($exchange_rate, 2, '.', '');
                    return $exchange_rate * $value . ' ' . $to_Curr;
                }
            }
        }*/
        $shipment = $this->shipment ;
        $result = $value + doubleval($shipment) ;

        return $result . ' جنيه ';
    }

    public function getPrice()
    {
      $price = explode(" " , $this->price) ;
      $realPrice  = (double)($price[0]) - (double)($this->shipment) ;
      return $realPrice ;
    }

    public function getShipmentAttribute($value)
    {
        return $value . ' ' . 'جنيه';
    }

    public function currencyConverter($to_Currency)
    {
        $to_Currency = $to_Currency;
        $rate = Swap::latest('GBP/' . $to_Currency, ['cache_ttl' => 120]);
        $rate = round($rate->getValue(), 2);
        Session::set('rate', $rate);
        Session::set('curr', $to_Currency);
        return $rate;
    }

    public function getRealPrice()
    {
        $orders = $this->orders;
        $checkout_amount = 0;
        foreach ($orders as $order) {
            $checkout_amount += $order->price;
        }

        return $checkout_amount;
    }
    public function payment_method()
    {
      return $this->belongsTo('App\PaymentMethod');

    }
    public function payment_method_name()
    {
      if ($this->payment_method->id == 1) {
        return 'الدفع عند التوصيل' ;
      }elseif ($this->payment_method->id == 2) {
        return 'باي بال' ;
      }else {
        return 'واير ترانسفير' ;
      }
    }
    public function purchase_status()
    {
      if ($this->purchase_status == 'pending') {
        return 'قيد الانتظار' ;
      }elseif ($this->purchase_status == 'in progress') {
        return 'فى تقدم' ;
      }elseif ($this->purchase_status == 'canceled') {
        return 'ملغاة' ;
      }elseif ($this->purchase_status == 'delivered') {
        return 'تم التوصيل' ;
      }else {
        return 'استرجاع' ;
      }
    }
    public function purchase_in_store($store_id)
    {
        return $this->product_store_quantity()->where('store_id', $store_id)->get();
    }

    public function stores()
    {
      $storesId = ProductStoreQuantity::where('purchase_id' , $this->id)->pluck('store_id')->toArray();
      if (count($storesId) > 0) {
        $stores = Store::whereIn('id' , $storesId)->get();
      }else {
        $stores = null;
      }
      return $stores ;
    }

    public function productStores($id)
    {
      $storesId = ProductStoreQuantity::where('purchase_id' , $this->id)->where('product_id' , $id)->pluck('store_id')->toArray();
      if (count($storesId) > 0) {
        $stores = Store::whereIn('id' , $storesId)->get();
      }else {
        $stores = null;
      }
      return $stores ;
    }
    public function storeQuantities($id , $product_id)
    {
      $quantity = ProductStoreQuantity::where('purchase_id' , $this->id)->where('store_id' , $id)->where('product_id' , $product_id)->first();

      return $quantity->quantity ;
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

}
