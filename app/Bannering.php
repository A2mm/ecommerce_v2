<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;
use App\BanneringType;

class Bannering extends Model
{
	use SoftDeletes;
  use LogsActivity;

    protected $fillable = [
      'image', 'title', 'bannering_type_id', 'full_image', 'banner_link',
    ];

    protected $table = 'bannerings';

    // protected static $logFillable = true;
    protected static $logAttributes = ['title', 'bannering_type_id', 'full_image', 'banner_link',];

    public function tapActivity(Activity $activity, string $eventName)
    {
      require '../../activityipget.php'; 
      $activity->ip = $ip;
    }

    public function image_path(){
      return 'shop_images/banners/' . $this->image;
    }
    public function full_image_path()
    {
      return 'shop_images/banners/' . $this->full_image;
    }
    public function banneringtype()
    {
      return $this->belongsTo(BanneringType::class);
    }

    public function btype_name()
    {
      $btype = BanneringType::where('id', $this->bannering_type_id)->select('name')->first();
      return $btype->name;
    }
}
