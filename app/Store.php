<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\Order; 
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class Store extends Model
{
    use LogsActivity; 

    protected $fillable = ['name', 'address', 'phone'];
  
    protected static $logFillable = true;

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
      require '../../activityipget.php'; 
      $activity->ip = $ip;
    }

    public function sellers()
    {
        return $this->hasMany('App\Seller');
    }

    public function product_store_quantity()
    {
        return $this->hasMany('App\ProductStoreQuantity');
    }

    public function quantity_in_store($product_id)
    {
       // return $this->product_store_quantity()->where('product_id', $product_id)->sum('quantity');
       $ones = ProductStoreQuantity::where('store_id', $this->id)
                                   //->where('custom_status', '!=', 'in progress')
                                   ->where('product_id', $product_id)
                                   // ->where('custom_status', '!=', 'delivered')
                                   ->get();
        $qty = 0;
        foreach ($ones as $one) {
            if ($one->custom_status == 'in progress') {
                  continue;
              }  
              else{
                $qty += $one->quantity;
              }
        } 

        return $qty;
    }
    public function quantity_of_product($product_id)
    {
      $quantity = 0;
      $product_states  = ProductStoreQuantity::where([
        'product_id' => $product_id,
        'store_id' => $this->id,
        ])->get();
      foreach ($product_states as $key => $value) {
        $quantity += (int)$value->quantity;
      }
      return $quantity;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
