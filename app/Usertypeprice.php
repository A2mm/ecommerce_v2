<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Usertype;
use App\Product;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class Usertypeprice extends Model
{
	use LogsActivity;

    protected $fillable = ['usertype_id', 'product_id', 'price'];

    protected static $logFillable = true;

    
    public function usertype()
    {
        return $this->belongsTo(Usertype::class);
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
      require '../../activityipget.php'; 
      $activity->ip = $ip;
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

