<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\User;
use Datatables;
use Mail;

class OwnerOrderController extends Controller
{
    public function getData()
    {
        $orders = Order::with(['user', 'product']);
        return Datatables::of($orders)
            ->make(true);
    }

    public function getShowAll()
    {
        $orders = Order::all();
        foreach ($orders as $order) {
            $product = Product::where('id', $order->product_id)->first();
            $order['product'] = $product;
        }
        return view('owner_dashboard.orders.all', compact('orders'));
    }

    public function cartSendMail($id)
    {
        $client = User::where('id', $id)->first();
        if ($client) {
            $usermail = $client->email;
            $orders = $client->orders;
            $products = [];
            $subject = __('translations.luxgems_reminds_you_with');
            if (count($orders) > 0) {
                foreach ($orders as $order) {
                    $product = Product::where('id', $order->product_id)->first();
                    if (!$product) {
                        abort(404);
                    }
                    array_push($products, $product);
                }
            }
            $subject = __('translations.message_from_luxgems');
            if ($usermail && $usermail != '') {
                Mail::send('owner_dashboard.orderMail', ['products' => $products], function ($message) use ($usermail, $subject) {
                    $message->from('Luxgems@gmail.com', 'Luxgems');
                    $message->to($usermail);
                    $message->subject($subject);
                });
            }
            return back()->withMessage(__('translations.email_sent_to_the_user'));
        }
        abort(404);

    }

}
