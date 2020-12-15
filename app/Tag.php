<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class Tag extends Model
{
    use SoftDeletes;
    use LogsActivity;

     protected $fillable = ['product_id', 'tag'];
     protected $dates    = ['deleted_at'];

     protected static $logFillable = true;

    /*public function tapActivity(Activity $activity, string $eventName)
    {
      require '../../activityipget.php'; 
      $activity->ip = $ip;
    }*/

     public function product()
    {
      return $this->belongsTo('\App\Product');
    }
}
