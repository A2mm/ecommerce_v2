<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class OnlineDiscount extends Model
{
	use LogsActivity;

    protected $table = 'online_discounts';
    protected $fillable = ['discount' , 'product_id'];

    protected static $logFillable = true;

    public function tapActivity(Activity $activity, string $eventName)
    {
      require '../../activityipget.php'; 
      $activity->ip = $ip;
    }

    public function product()
    {
      $product = Product::where('id' , $this->product_id)->first();
      return $product->name ;
    }

}
