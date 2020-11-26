<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class Subcategory extends Model
{

    //use SoftDeletes;
    use LogsActivity;
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    protected $fillable = ['name', 'category_id'];

    protected static $logFillable = true;

    public function products(){
        return $this->hasMany('App\Product');
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
      require '../../activityipget.php'; 
      $activity->ip = $ip;
    }

    public function category(){
      return $this->belongsTo('App\Category');
    }

    public function siblings(){
      return $this->category->subcategories;
    }
/*
  public function supplier(){
      return $this->belongsToMany('App\User', 'suppliers');
    }
*/   
}
