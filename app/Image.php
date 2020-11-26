<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class Image extends Model
{
	use LogsActivity;

    protected $table = 'images';
    protected $fillable = ['image','product_id'];
    
    protected static $logFillable = true;

    public function product()
    {
      return $this->belongsTo('\App\Product');
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
      require '../../activityipget.php'; 
      $activity->ip = $ip;
    }
}
