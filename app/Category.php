<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;


class Category extends Model
{
  use SoftDeletes;
  use \Staudenmeir\EloquentHasManyDeep\HasRelationships;
  use LogsActivity;

  protected $fillable = ['name'];
  protected $dates = ['deleted_at'];

  protected static $logFillable = true;

  public function subcategories(){
      return $this->hasMany('App\Subcategory');
  }

  public function tapActivity(Activity $activity, string $eventName)
    {
      require '../../activityipget.php'; 
      $activity->ip = $ip;
    }


  public function products(){
      return $this->hasManyDeep('App\Product',['App\Subcategory']);
  }
  public function hasProducts(){
    return Product::where('category_id', $this->id)->count();
  }
  public function hasSubcategories()
  {
    return Subcategory::where('category_id',$this->id)->count();
  }

  public function histories()
  {
      return $this->hasManyDeep('App\History', ['App\Subcategory', 'App\Product']);
  }
}
