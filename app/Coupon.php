<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use LogsActivity;
    use SoftDeletes;

    protected $table = 'coupones';
    protected $dates = ['deleted_at'];

    protected $fillable = ['code', 'owner_id', 'owner_name', 'expiry_date', 'type', 'restrict_price', 'product_id', 'discount', 'flat_rate'];

    protected static $logFillable = true;

    public function tapActivity(Activity $activity, string $eventName)
    {
      require '../../activityipget.php';
      $activity->ip = $ip;
    }

    public function product()
    {
        return $this->belongsTo('App\Product')->withTrashed();
    }

    public function IsExpire()
    {
        $now = \Carbon\Carbon::now()->toDateTimeString();
        if ($now > $this->expiry_date) {
            return true;
        }
        return false;
    }

   /* public function getTypeAttribute($attribute)
    {
        if ($attribute == 'product_discount') {
           $value = 'خصم المنتج';
        }
        else {
            $value = 'السعر الاجمالي' ;
        }
        return $value; 

    //  return [
    //    'flat_rate' => 'سعر محدد' ,
    //    'product_discount' => 'خصم المنتج' ,
    //    'total_price' => 'السعر الاجمالي' ,
    //  ][$attribute]; 
    } 
    */
}
