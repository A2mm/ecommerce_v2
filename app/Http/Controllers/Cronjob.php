<?php

namespace App\Http\Controllers;

use App;
use App\Cart;
use App\Order;
use App\Product;
use App\User;
use Carbon\Carbon;
use Mail;

class Cronjob extends Controller
{
    public function checkUsersCart()
    {
        $orders = Order::where('deleted_at', null)->get();
        $now = Carbon::now();
        foreach ($orders as $order) {
            $order_date = Carbon::parse($order->created_at);
            $diff = $order_date->diffInHours($now);
            if ($diff >= 72) {
                $product = Product::where('id', $order->product_id)->first();
                if ($product) {
                    $usermail = $order->user->email;
                    $subject = "Message from LUXGEMS";
                    if ($usermail && $usermail != '') {
                        Mail::send('owner_dashboard.expireCart', ['product' => $product, 'diff' => $diff], function ($message) use ($usermail, $subject) {
                            $message->from('Luxgems@gmail.com', 'Luxgems');
                            $message->to($usermail);
                            $message->subject($subject);
                        });
                    }
                    $cart = Cart::create([
                        'product_id' => $product->id,
                        'vendor_id' => $product->vendor_id,
                        'store_id' => $product->store_id,
                        'quantity' => $order->quantity,
                        'reason' => 'order in cart expired',
                    ]);
                }
                $order->delete();
            } else if ($diff == 24 && $diff == 48) {
                $product = Product::where('id', $order->product_id)->first();
                if ($product) {
                    $usermail = $order->user->email;
                    $subject = "Message from LUXGEMS";
                    if ($usermail && $usermail != '') {
                        Mail::send('owner_dashboard.expireCart', ['product' => $product, 'diff' => $diff], function ($message) use ($usermail, $subject) {
                            $message->from('Luxgems@gmail.com', 'Luxgems');
                            $message->to($usermail);
                            $message->subject($subject);
                        });
                    }
                }
            }
        }

    }
}
