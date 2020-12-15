<?php

namespace App;

use Auth;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Usertype;
use App\Order;
//use Spatie\Activitylog\Traits\LogsActivity;
 use Spatie\Permission\Traits\HasRoles;
//use Spatie\Activitylog\Contracts\Activity;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    // use LogsActivity;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

   // protected static $logAttributes = ['name', 'email', 'phone', 'usertype_id', 'role', 'suspend', 'image', 'password'];

    protected $fillable = [
        'slug', 'name', 'email', 'password', 'new_email', 'new_name', 'prev_privillige', 'country_id', 'usertype_id' ,'role', 'payee_name', 'bank_account', 'language', 'hoppy', 'sex', 'job', 'birthdate', 'api_token', 'status', 'code', 'points', 'facebook_id', 'customerOrNot', 'phone', 'address', 'deleted_at', 'image',  'suspend'
    , 'new_phone'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];


    public function role($role)
    {
        return (Auth::user()->role == $role) ? true : false;
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /*public function getImageAttribute($value)
    {
        return 'clients/images/'.$value;
    }*/
/*
    public function products()
    {
        return $this->hasMany('App\Product', 'vendor_id');
    }
*/
/*
    public function links()
    {
        return $this->hasMany('App\Link');
    }
*/
/*
    public function visits()
    {
        return $this->hasManyThrough('App\Visit', 'App\Link');
    }
*/
/*
    public function affiliate_orders()
    {
        return $this->hasManyThrough('App\Order', 'App\Link');
    }
*/

    public function cart_summary_count()
    {
        $orders = Order::where('user_id', $this->id)->count();
        return $orders;
    }


    public function cart_summary_api()
    {
        $orders = $this->orders->count() ?? null;
        return $orders ;
    }

/*
    public function scopegetRole($query, $role)
    {
        return $query->where('role', $role);
        //return self::where('role', $role)->get();
    }
*/
/*
    public function country()
    {
        return $this->belongsTo('App\Country');
    }
*/
/*
    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y/m/d, H:i');
    }
*/
/*
    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y/m/d, H:i');
    }
*/
/*
    public function supply()
    {
        return $this->belongsToMany('App\Subcategory', 'suppliers');
    }
*/
/*
    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
*/
/*
    public function message()
    {
        return $this->hasMany('App\Ticket');
    }
*/
/*
    public function wish_products()
    {
        return $this->hasManyThrough(
          'App\Product',
          'App\Wish',
          'user_id', // Foreign key on users table...
          'id', // Foreign key on posts table...
          'id', // Local key on countries table...
          'product_id' // Local key on users table...
        );
    }
*/
/*
    public function ordered_products()
    {
        return $this->hasManyThrough(
          'App\Product',
          'App\Order',
          'user_id', // Foreign key on users table...
          'id', // Foreign key on posts table...
          'id', // Local key on countries table...
          'product_id' // Local key on users table...
        );
    }
*/
/*
    public function visitMoney()
    {
        $total_view_cost = 0;
        foreach ($this->links as $link) {
            $total_view_cost += $link->product->view_cost * $link->visits;
        }
        return $total_view_cost;
    }
*/
/*
    public function orderMoney()
    {
        $total_view_cost = 0;
        foreach ($this->links as $link) {
            $total_view_cost += $link->product->order_cost * $link->orders;
        }
        return $total_view_cost;
    }
*/
    public static function getWithApiToken($api_token)
    {

        return $user = User::where('api_token', $api_token)->first();
    }

/*
    public function coupons()
    {
        return $this->belongsToMany('Coupon');
    }
*/

    public function history()
    {
        return $this->hasMany('App\History');
    }
/*
    public function wish()
    {
        return $this->hasMany('App\Wish');
    }
*/
/*
    public function reviews()
    {
        return $this->hasMany('App\Review');
    }
*/
    public function purchases()
    {
        return $this->hasMany('App\Purchase');
    }

    public function OwnerPrivilege()
    {
        return $this->hasMany('App\OwnerPrivilege');
    }
    public function privileges()
    {
        return $this->hasMany('App\OwnerPrivilege')->pluck('privilege');
    }
/*
    public function moneyAmount()
    {
        $total_view_cost = 0;
        foreach ($this->links as $link) {
            $total_view_cost += $link->product->view_cost * $link->visits;
        }
        return $total_view_cost;
    }
*/
    public function checkPromoCode($coupon)
    {
        $orders = Order::with(array('product' => function ($query) {
            $query->select('id', 'name');
        }))->where('user_id', $this->id)->latest()->get();
        $checkout_amount = 0;
        if ($orders->count()) {
            foreach ($orders as $order) {
                $price = $order->getProductPrice();
                $checkout_amount += $order->quantity * $price;
            }
        }
        $checkout_amount > 0 ? $checkout_amount = $checkout_amount  : '';
        if ($coupon->type == 'flat_rate') {
       // if ($coupon->type === $coupon->getTypeAttribute('flat_rate')) {
            if ($checkout_amount >= $coupon->restrict_price) {
                return true;
            }
            return false;
        }
        if ($coupon->type == 'total_price') {
            // if ($coupon->type === $coupon->getTypeAttribute('total_price')) {
            if ($checkout_amount > 0) {
                return true;
            }
            return false;
        }
        if ($coupon->type == 'product_discount') {
          //   if ($coupon->type === $coupon->getTypeAttribute('product_discount')) {
            foreach ($orders as $order) {
                if ($order->product->id === $coupon->product_id) {
                    return true;
                }
            }
            return false;
        }
        return false;
    }
    public function getTotalAfterPromo($coupon)
    {
        $orders = Order::with(array('product' => function ($query) {
            $query->select('id', 'name');
        }))->where('user_id', $this->id)->latest()->get();
        $checkout_amount = 0;
        if ($orders->count()) {
            foreach ($orders as $order) {
                $price = $order->getProductPrice();
                $checkout_amount += $order->quantity * $price;
            }
        }
        $checkout_amount > 0 ? $checkout_amount = $checkout_amount : '';
        // if ($coupon->type === $coupon->getTypeAttribute('flat_rate')) {
        //     return $checkout_amount - $coupon->flat_rate;
        // }
        if ($coupon->type == 'total_price') {
      // if ($coupon->type === $coupon->getTypeAttribute('total_price')) {
            $discount = $coupon->discount;
            $discount_price = $checkout_amount * ($discount / 100);
            $amount_after_discount = $checkout_amount - $discount_price;
            return $amount_after_discount;
        }
        if ($coupon->type == 'product_discount') {
           //  if ($coupon->type === $coupon->getTypeAttribute('product_discount')) {
            $checkout_amount = 0;
            foreach ($orders as $order) {
                $price = $order->getProductPrice();
                if ($order->product->id === $coupon->product_id) {
                    $discount = $coupon->discount;
                    $discount_price = $price * ($discount / 100);
                    $product_after_discount = $price - $discount_price;
                    $checkout_amount += $order->quantity * $product_after_discount;
                } else {
                    $checkout_amount += $order->quantity * $price;
                }
            }
            return $checkout_amount;
        }
    }

    public function updateOrder($coupon)
    {
       /* $orders = Order::with(array('product' => function ($query) {
            $query->select('id', 'name');
        }))->where('user_id', $this->id)->latest()->get();*/ 

         $orders = Order::where('user_id', $this->id)->where('seller_id', null)->where('store_id', null)->get();

        if ($orders->count()) {
            foreach ($orders as $order) {
              $price = $order->price;
              if ($coupon->type == 'total_price') {
            // if ($coupon->type === $coupon->getTypeAttribute('total_price')) {
                $discount = $coupon->discount;
                $discount_price = $order->price * ($discount / 100);
                $amount_after_discount = $order->price  - $discount_price;
                $order->update([
                  'price'=> $amount_after_discount ,
                ]);
              }elseif ($coupon->type == 'product_discount') {
                // }elseif ($coupon->type === $coupon->getTypeAttribute('product_discount')) {
                if ($order->product->id === $coupon->product_id) {
                    $discount = $coupon->discount;
                    $discount_price = $price * ($discount / 100);
                    $product_after_discount = $price - $discount_price;
                    $order->update([
                      'price' => $product_after_discount ,
                    ]);
                } else {
                  $order->update([
                    'price' => $price ,
                  ]);
                }
              }

            }
        }

    }
    /*
    /*
*/
    public function usertype()
    {
        return $this->belongsTo(Usertype::class);
    }
}
