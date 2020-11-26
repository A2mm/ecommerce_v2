<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class Shipment extends Model
{
	use LogsActivity;
	
    protected $fillable = ['governorate' , 'area' , 'price'];

    protected static $logFillable = true;

    public function tapActivity(Activity $activity, string $eventName)
    {
      require '../../activityipget.php'; 
      $activity->ip = $ip;
    }
}
