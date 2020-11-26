<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class Seller extends Model
{
    use LogsActivity;

    protected $fillable = ['name', 'email', 'password', 'suspend', 'api_token', 'discount', 'store_id'];
    protected static $logFillable = true;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function tapActivity(Activity $activity, string $eventName)
    {
      require '../../activityipget.php'; 
      $activity->ip = $ip;
    }

    public function store()
    {
        return $this->belongsTo('App\Store');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
