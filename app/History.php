<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use App\User;

class History extends Model
{
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = ['user_id', 'product_id', 'country_code', 'seller_id', 'store_id', 'price', 'bill_id', 'quantity', 'refunded', 'purchase_id', 'order_status', 'order_id', 'sellerdiscount', 'original'];

    protected static $logFillable = true;

    /*public function tapActivity(Activity $activity, string $eventName)
    {
      require '../../activityipget.php';
      $activity->ip = $ip;
    }*/

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function order()
    {
        return $this->belongsTo('App\Order')->withTrashed();
    }

    public function purchase()
    {
        return $this->belongsTo('App\Purchase');
    }

    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    public function seller()
    {
        return $this->belongsTo('App\Seller');
    }

    public function order_status()
    {
      if ($this->order_status == 'pending') {
        return 'قيد الانتظار' ;
      }elseif ($this->order_status == 'in progress') {
        return 'فى تقدم' ;
      }elseif ($this->order_status == 'canceled') {
        return 'ملغاة' ;
      }elseif ($this->order_status == 'delivered') {
        return 'تم التوصيل' ;
      }else {
        return 'استرجاع' ;
      }
    }

    public function priceAfterDiscount()
    {
        $productId = $this->product_id ;
        $product = Product::findOrFail($productId);
        if ($product->discount) {
          $price_after_discount = $this->price - ($this->price * ($product->discount/100));
        }else {
          $price_after_discount = $this->price;
        }

        return $price_after_discount;
    }

    public function date()
    {
      return $this->created_at ;
    }

}
