<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class CategoryOnline extends Model
{
  use LogsActivity;

  protected static $logFillable = true;

  /*public function tapActivity(Activity $activity, string $eventName)
    {
      require '../../activityipget.php'; 
      $activity->ip = $ip;
    }*/

    protected $table = 'category_onlines';

    protected $fillable = ['name', 'description'];


    public function products()
    {
      return $this->hasMany('\App\Product' , 'category_online_id');
    }
}
