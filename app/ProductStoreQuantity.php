<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Barcode;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class ProductStoreQuantity extends Model
{
    use LogsActivity;
   
    protected $fillable = ['quantity', 'reason', 'store_id', 'product_id', 'type', 'purchase_id', 'shiporder_id', 'status', 'transfer_id', 'to_store', 'from_store', 'refund_id', 'settle_id', 'custom_status', 'seller_id'];  
                
   // protected $guarded = [];

    protected static $logFillable = true;


    public function purchase()
    {
        return $this->belongsTo('App\Purchase');
    }

    /*public function tapActivity(Activity $activity, string $eventName)
    {
      require '../../activityipget.php'; 
      $activity->ip = $ip;
    }*/

    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    public function product()
    {
        return $this->belongsTo('App\Product');
    }

/*
    public function barcodes()
    {
        return $this->hasMany('App\Barcode');
    }
*/

/*
    public function barcode_movements()
    {
      return $this->belongsToMany('App\Barcode','barcode_movements');
    }
*/

/*
    public function getRemainingAttribute()
    {
        return abs($this->quantity) - $this->barcodes()->count();
    }
*/

}
