<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use App\Country;
use App\User;
use App\ProductStoreQuantity;
use App\Barcode;
use App\BarcodeMovement;
use Carbon\Carbon;
use DB;
use Session;
use Swap;
use App\Usertypeprice;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

class Product extends Model
{
    use SoftDeletes;
    use \Znck\Eloquent\Traits\BelongsToThrough;
    use LogsActivity;

    protected static $logFillable = true;

    protected $fillable = ['quantity', 'archive', 'category_id', 'slug', 'name', 'status', 'subcategory_id', 'unique_id', 'discount', 'num_of_orders', 'weight', 'available_online', 'description' , 'category_online_id', 'seo_description', 'product_benefits'];

    protected $hidden = ['created_at', 'updated_at'];

    public $preventAttrSet = false;

    public function pricing($id)
    {
        $item = Usertypeprice::where('product_id', $id)->where('usertype_id', 1)->first();
        $one = $item['price'];
        return $one;
    }

     public function usertypepricess()
    {
       return $this->hasMany('App\Usertypeprice');
    }

    public function availableQuantity()
    {
     /* $purchaseIds = Purchase::where('purchase_status' , 'pending')->pluck('id')->toArray();
      $quantity = Order::whereIn('purchase_id' , $purchaseIds)->where('product_id' , $this->id)->withTrashed()->sum('quantity');
      $checkQuantity = Order::where('product_id' , $this->id)->where('purchase_id', null)->sum('quantity');
    // $checkQuantity = Order::where('product_id' , $this->id)->sum('quantity');
     // $avQuantity   = $quantity ? $this->quantity_in_stores() - ( $quantity + $checkQuantity) : $this->quantity_in_stores();
     $avQuantity  = $this->quantity_in_stores() - ($quantity);
      if ($avQuantity <= 0) {
         $availableQuantity = 0;
      }
      else
      {
          $availableQuantity = $avQuantity;
      }
      return $availableQuantity ;*/
       $ones  = ProductStoreQuantity::where('product_id', $this->id)
                                                  //->where('custom_status', '!=', 'in progress')
                                                   ->get();
                                                  //->sum('quantity');
      
        $qty = 0;
        foreach ($ones as $one) {
          /*  if ($one->custom_status == 'in progress') {
                  continue;
              }  
              else{*/
                $qty += $one->quantity;
             // }
        } 

        return $qty; 
    }

    public function existQuantity()
    {
      /*
      $purchaseIds = Purchase::where('purchase_status' , 'pending')->pluck('id')->toArray();
      $quantity = Order::whereIn('purchase_id' , $purchaseIds)->where('product_id' , $this->id)->withTrashed()->sum('quantity');
      // $checkQuantity = Order::where('product_id' , $this->id)->sum('quantity');
      $availableQuantity  = $quantity ? $this->quantity_in_stores() - $quantity  : $this->quantity_in_stores() ;
      return $availableQuantity ;
      */

      $ones  = ProductStoreQuantity::where('product_id', $this->id)
                                                  //->where('custom_status', '!=', 'in progress')
                                                   ->get();
                                                  //->sum('quantity');
        $qty = 0;
        foreach ($ones as $one) {
            if ($one->custom_status == 'in progress') {
                  continue;
              }  
              else{
                $qty += $one->quantity;
              }
        } 

        return $qty; 
    }

    public function inprogressQuantity()
    {
       $ones  = ProductStoreQuantity::where('product_id', $this->id)
                                                  //->where('custom_status', '!=', 'in progress')
                                                   ->get();
                                                  //->sum('quantity');
      
        $qty = 0;
        foreach ($ones as $one) {
            if ($one->custom_status == 'in progress') {
                  $qty += $one->quantity;
              }  
              else{
                continue;
              }
        } 

        return $qty; 
       // return $availableQuantity;
    }

    public function category_online()
    {
      return $this->belongsTo('\App\CategoryOnline' , 'category_online_id');
    }

    public function setAvailableOnlineAttribute($value)
    {
        $this->attributes['available_online'] = (boolean)($value);
    }
    // NEVER USE THIS RELATIONSHIP, IT IS REMOVED
    public function store()
    {
        return $this->belongsTo('App\Store');
    }
    /////////////////////////////////////////////

    public function stores()
    {
        return $this->hasManyThrough('App\Store', 'App\ProductStoreQuantity', 'product_id', 'id', 'id', 'store_id')->distinct();
    }

    /*public function tapActivity(Activity $activity, string $eventName)
    {
      require '../../activityipget.php';
      $activity->ip = $ip;
    }*/

    public function images()
    {
      return $this->hasMany('\App\Image' , 'product_id' , 'id');
    }

     public function tags()
    {
      return $this->hasMany('\App\Tag' , 'product_id' , 'id');
    }

    public function productstores()
    {
        return $this->belongsToMany(Store::class);
    }

    public function product_store_quantity()
    {
        return $this->hasMany('App\ProductStoreQuantity');
    }

    public function quantity_in_store($store_id)
    {
        return $this->product_store_quantity()->where('store_id', $store_id)
                                             // ->where('quantity', '>=', 0)
                                              ->sum('quantity');
    }

    public function quantity_in_stores()
    {
        return $this->product_store_quantity()->sum('quantity');
    }

    public function quantity_in_stores2()
    {
        $ones = ProductStoreQuantity::where('store_id', $this->id)
                                   //->where('custom_status', '!=', 'in progress')
                                   ->where('product_id', $product_id)
                                   // ->where('custom_status', '!=', 'delivered')
                                   ->get();
        $qty = 0;
        foreach ($ones as $one) {
            if ($one->custom_status == 'in progress') {
                  continue;
              }  
              else{
                $qty += $one->quantity;
              }
        } 

        return $qty;
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function product_store_quantities()
    {
        return $this->hasMany('App\ProductStoreQuantity');
    }

    public function payment_method()
    {
      return $this->belongsTo('App\PaymentMethod');

    }

    public function productImages()
    {
      $images  = Image::where('product_id' , $this->id)->select('image')->get();
      $allImages = [];
      foreach ($images as $key => $value) {
        $allImages[] = asset('storage/' . $value->image);
      }
      return $allImages ;
    }

    public function product_main_image()
    {
      $image = Image::where('product_id' , $this->id)->first();
      $main_image = $image ? asset('storage/' . $image->image) : NULL ;
      return $main_image;
    }

    public function productPrices()
    {
      $price = Usertypeprice::where('product_id' , $this->id)->where('usertype_id' , 1)->select('price')->first();
      $existPrice = $price ? $price->price : NULL ;
      return $existPrice;
    }

    public function getProductPrice()
    {
        $discountProducts = OnlineDiscount::pluck('product_id')->toArray();
        $priceType = $this->productPrices();
        if (in_array($this->id , $discountProducts)) {
            $onlineDiscount = OnlineDiscount::where('product_id' , $this->id)->first();
            $price = $onlineDiscount->discount;
        }else {
            $price = $priceType ;
        }
        return $price ;
    }




  /*  public function getQuantityAttribute($value)
    {
        $amount_in_non_complete_purchases = $this->orders()->withTrashed()->whereHas('Purchase', function ($query) {
          $query->whereDoesntHave('product_store_quantity');
        })->sum('quantity');
// return $amount_in_non_complete_purchases;
        $quantity = 0;
        $product_store_quantities = $this->product_store_quantities->sum('quantity');

        // $quantity = $product_store_quantities - $amount_in_non_complete_purchases;
         $quantity = $product_store_quantities;
        if ($quantity >=  0) {
            return $quantity;
        } else {
            return 0;
        }

    }*/


    public function subcategory()
    {
        return $this->belongsTo('App\Subcategory');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function currency()
    {
        return $this->belongsTo('App\Currency');
    }

    public function order()
    {
        return $this->hasMany('App\Order');
    }

    public function histories()
    {
        return $this->hasMany('App\History' , 'product_id');
    }

    // get discount attribute according to currency in the URL

    public function getDiscountPercentageAttribute()
    {
      return $this->discount." %";
    }

    public function priceafterdiscount($id)
    {
        $product = Product::where('id', $id)->first();
        $discount =  $product['discount'];
        $price = $product->pricing($product->id);
        $sub = $price * ($discount / 100);
        $priceafterdiscount = $price - $sub;
        return $priceafterdiscount. ' جنيه';

    }
    // public function getPriceAfterDiscountAttribute()
    // {
    //   $discount_percentage = $this->discount/100;
    //    $price = explode(' ',$this->price);
    //   $discount = $discount_percentage * $price[0];
    //   $price_after_discount = $price[0] - $discount;
    //    return $price_after_discount . " " . $price[1];
    // }

    public function discount()
    {
      $onlineDiscount = OnlineDiscount::where('product_id' , $this->id)->first();
      $priceType = $this->productPrices();
      $priceDiscount = $onlineDiscount ? $onlineDiscount->discount : $this->productPrices() ;
      $diff = $priceType  - $priceDiscount ;
      $discount = $diff > 0 ? ($diff/$priceType) * 100   : NULL ;
      return $discount ;
    }
    public function priceWithDiscount()
    {
      $onlineDiscount = OnlineDiscount::where('product_id' , $this->id)->first();
      $price = Usertypeprice::where('usertype_id' , 1)->where('product_id' , $this->id)->first();
      $discount = $onlineDiscount ? $onlineDiscount->discount  : NULL ;
      $priceAfterDiscount = is_null($discount) ? $price->price :  $onlineDiscount->discount ;
      return $priceAfterDiscount ;
    }



    public function getSellerPriceType($quantity = null, $usertype_id)
    {
       $currency = 'جنية مصرى' ;

            $normal_price = Usertypeprice::where('product_id', $this->id)->where('usertype_id', $usertype_id)->first();
                if($normal_price->usertype_id == 1)
                {
                    /*$normal_price = Usertypeprice::where('product_id', $this->id)->where('usertype_id', 1)->first();*/
                    $currency = 'جنية مصرى' ;
                    $actual_price = $normal_price['price'];

                    if (isset($this->discount) && $this->discount != 0) {
                        $discount = explode(' ', $this->discount);

                        $priceafterdiscount = $actual_price - ($actual_price * $discount[0] / 100);
                        if ($quantity) {
                            $local_discount_without_currency = $priceafterdiscount * $quantity;
                        } else {
                            $local_discount_without_currency = $priceafterdiscount;
                        }
                        return $local_discount_without_currency . ' ' . $currency;
                    } else {

                        if ($quantity) {
                            $local_price_without_currency = $actual_price * $quantity;
                        } else {
                            $local_price_without_currency = $actual_price;
                        }
                        return $local_price_without_currency . ' ' . $currency;
                    }
                }
                else
                {
                    $currency = 'جنية مصرى' ;
                    $actual_price = $normal_price['price'];

                        if ($quantity) {
                            $local_price_without_currency = $actual_price * $quantity;
                        } else {
                            $local_price_without_currency = $actual_price;
                        }
                        return $local_price_without_currency . ' ' . $currency;
                }
    }


}
