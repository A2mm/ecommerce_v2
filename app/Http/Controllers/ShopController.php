<?php

namespace App\Http\Controllers;

use App;
use App\Accessory;
use App\Auction;
use App\AuctionTransaction;
use App\Cart;
use App\Category;
use App\Coupon;
use App\Currency;
use App\DigitalProduct;
use App\History;
use App\Link;
use App\Order;
use App\PasswordReset;
use App\Product;
use App\Purchase;
use App\Review;
use App\Shape;
use App\Subcategory;
use App\Supplier;
use App\User;
use App\Vendor;
use App\View;
use App\Visit;
use App\Wish;
use Auth;
use Carbon\Carbon;
use DB;
//use Illuminate\Support\Facades\Auth;
use Hash;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Mail;
use Pusher;
use Share;
use SoapClient;
use Socialite;
use Swap;

class ShopController extends Controller
{

    public function getSetting()
    {
        $women = Product::whereIn('category_id', [1, 4])->get();
        $men = Product::whereIn('category_id', [2, 4])->get();
        $kids = Product::where('category_id', 3)->get();
        count($women) > 0 ? $w_check = 1 : $w_check = 0;
        count($men) > 0 ? $m_check = 1 : $m_check = 0;
        count($kids) > 0 ? $k_check = 1 : $k_check = 0;
        return view('shop.settings', compact('w_check', 'm_check', 'k_check'));
    }

    public function getLogin()
    {
        return view('shop.login');
    }
    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ], [
            'email.exists' => 'please check your email',
        ]);
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'status' => 1])) {
            if (Auth::user()->cart_summary() > 0) {
                if ($request->has('redirectTo')) {
                    return redirect($request->redirectTo)->with('message', trans('layout.login_message') . ' ' . Auth::user()->cart_summary() . ' ' . trans('layout.Order') . ' ' . trans('layout.login_message_part2'));
                } else {
                    return redirect('/')->with('message', trans('layout.login_message') . ' ' . Auth::user()->cart_summary() . ' ' . trans('layout.Order') . ' ' . trans('layout.login_message_part2'));
                }
            } else {
                if ($request->has('redirectTo')) {
                    return redirect($request->redirectTo);
                } else {
                    return redirect('/');
                }
            }
        } else {

            return back()->with('message', trans('layout.Wrong_Credinticals'));
        }

        Auth::login($user, true);
        return redirect('/');
    }

    public function getRegister()
    {
        return view('shop.register');
    }
    public function postRegister(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            //'password' => 'required|min:6|confirmed'
            'password' => 'required|min:6',
        ]);
        if (filter_var($request->name, FILTER_VALIDATE_EMAIL) || preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $request->name)) {
            return back()->withErrors('invalid username');
        }

        $contactEmail = $request['email'];
        $subject = "Luxgems verification";
        //$content = $request['name'];
        $code = str_random(6);
        Mail::send('shop.emailverificationPage', ['code' => $code], function ($message) use ($contactEmail, $subject) {
            $message->from('me@gmail.com', 'Luxgems');
            $message->to($contactEmail);
            $message->subject($subject);
        });

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'status' => 0,
            'points' => 1000,
            'code' => $code,
            'api_token' => str_random(20),
        ]);

        return redirect('/')->with('message', 'check your email to be confirmed');
        //Auth::login($user, true);

    }
    public function verify($code)
    {

        $user = User::where('code', $code)->first();
        if ($user) {
            $user->update([
                'status' => 1,
            ]);
            Auth::login($user, true);
            return redirect('/');

        }
        abort(404);
    }
    public function getLogoutUser()
    {
        Auth::logout();
        return redirect('/');
    }

    public function getEditProfile()
    {
        return view('shop.edit');
    }

    public function postEditProfile(Request $request)
    {

        $user = Auth::user();
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:128|unique:users,email,' . $user->id,
        ]);

        $contactEmail = $request['email'];
        $subject = "Luxgems verification";
        $code = str_random(6);
        Mail::send('shop.updateVerificationPage', ['code' => $code], function ($message) use ($contactEmail, $subject) {
            $message->from('me@gmail.com', 'Luxgems');
            $message->to($contactEmail);
            $message->subject($subject);
        });
        $user->update([
            'code' => $code,
            'new_email' => $request->email,
            'new_name' => $request->name,
        ]);
        return redirect('/')->with('message', 'check your new email to update the profile');
    }

    public function updateVerify($code)
    {
        $user = User::where('code', $code)->first();
        if (!$user) {
            abort(404);
        }
        $user->update([
            'email' => $user->new_email,
            'name' => $user->new_name,
            'phone' => $user->new_phone ,
        ]);
        return redirect('https://royalbeeseg.com')->with('message', 'your account has been updated');
    }

    public function getChangePassword()
    {
        return view('shop.changePassword');
    }

    public function postChangePassword(Request $request)
    {
        $this->validate($request, [
            'current' => 'required|min:6',
            'new' => 'min:6|confirmed|different:current',
            //'new_confirmation' => 'required_with:new|min:6'
        ]);
        $user = User::find(Auth::id());
        if ($user) {
            $hashedPassword = $user->password;
            if (Hash::check($request->current, $hashedPassword)) {

                $user->fill([
                    'password' => Hash::make($request->new),
                ])->save();

                return redirect('/')->with('message', 'Your password has been changed');
            } else {
                return back()->withErrors('Wrong Info');
            }
        }
        abort(404);
    }

    public function search(Request $request)
    {
        $query = $request->input('word');

        if (!$query) {
            return back();
        }
        $category = Category::where('name', request()->g)->first();
        $products = Product::where('archive', 0)->where('in_auction', 0)->where('main_image', '!=', 'default.jpg')
            ->where('category_id', $category->id)->where(function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
                ->orWhere('arabic_name', 'LIKE', "%{$query}%")
                ->orWhere('unique_id', $query)
                ->orWhere('unique_id', $query);
        })->where('main_image', '!=', 'default.jpg')
            ->latest()->paginate(12);
        if (count($products) == 0) {
            if ($category->id == 1 || $category->id == 2) {
                $products = Product::where('archive', 0)->where('category_id', 4)->where(function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                        ->orWhere('arabic_name', 'LIKE', "%{$query}%")
                        ->orWhere('unique_id', $query)
                        ->where('main_image', '!=', 'default.jpg')
                        ->orWhere('unique_id', $query);
                })->latest()->paginate(12);
            }
        }
        foreach ($products as $product) {
            if (Auth::check()) {
                $wish = Wish::where('user_id', Auth::user()->id)->where('product_id', $product->id)->first();
                if ($wish) {
                    $product['wished'] = 1;
                } else {
                    $product['wished'] = 0;
                }
            } else {
                $product['wished'] = 0;
            }
        }
        return view('shop.search', compact('products'));
    }

    public function getProfile(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($request->has('g')) {
                $x = 1;
            } else {
                $x = 0;
            }
            $history = History::where('user_id', Auth::user()->id)->get();
            $wish = Wish::where('user_id', Auth::user()->id)->get();

            return view('shop.profile', compact('user', 'x', 'history', 'wish'));
        }
        return redirect('/');
    }

    public function getIndex()
    {
        $show_all_subcategorys = Subcategory::all();
        $category = Category::where('name', request()->g)->get()->first();
        $both = Category::where('name', 'Both')->get()->first();
        if (request()->g == 'Kids') {
            $temp_products = Product::where('category_id', $category->id)->where('main_image', '!=', 'default.jpg')->get();
        } else if ($category) {
            $temp_products = Product::whereIn('category_id', [$category->id, $both->id])->where('main_image', '!=', 'default.jpg')->get();
        } else {
            $temp_products = Product::where('category_id', $both->id)->where('main_image', '!=', 'default.jpg')->get();
        }
        $temp_shapes = [];
        $temp_accessories = [];
        $temp_subcategories = [];
        foreach ($temp_products as $product) {
            array_push($temp_shapes, $product->shape_id);
            array_push($temp_accessories, $product->accessory_id);
            array_push($temp_subcategories, $product->subcategory_id);
        }
        $categories = Category::all();
        $subcategories = Subcategory::whereIn('id', $temp_subcategories)->orderBy('name', 'asc')->get();
        $accessories = Accessory::whereIn('id', $temp_accessories)->orderBy('name', 'asc')->get();
        $shapes = Shape::whereIn('id', $temp_shapes)->orderBy('name', 'asc')->get();
        if ($category) {
            $new_products = Product::where([
                'category_id' => $category->id,
                'archive' => 0,
            ]);
        } else {
            $new_products = Product::where([
                'category_id' => $both->id,
                'archive' => 0,
            ]);
        }

        if (request()->g == 'Men' || request()->g == 'Women') {
            $new_products = Product::whereIn('category_id', [$category->id, $both->id]);
        }

        if (isset(request()->subcategory) && request()->subcategory != 'ALL') {
            $subcategory = (App::isLocale('ar')) ? Subcategory::where('arabic_name', request()->subcategory)->first() : Subcategory::where('name', request()->subcategory)->first();
            $products_available = Product::where('subcategory_id', $subcategory->id)->whereIn('category_id', [$category->id, $both->id])->where('main_image', '!=', 'default.jpg')->get();
            $shape_ids = [];
            $accessory_ids = [];
            foreach ($products_available as $product) {
                array_push($shape_ids, $product->shape_id);
                array_push($accessory_ids, $product->accessory_id);
            }
            $shapes = Shape::whereIn('id', $shape_ids)->get();
            $accessories = Accessory::whereIn('id', $accessory_ids)->get();
        }

        $new_products = (!isset(request()->subcategory) || request()->subcategory == 'ALL') ? $new_products : $new_products->where('subcategory_id', $subcategory->id);

        if (isset(request()->accessory) && request()->accessory != 'ALL') {
            $accessory = (App::isLocale('ar')) ? Accessory::where('arabic_name', request()->accessory)->first() : Accessory::where('name', request()->accessory)->first();
            $products_available = Product::where('accessory_id', $accessory->id)->whereIn('category_id', [$category->id, $both->id])->where('main_image', '!=', 'default.jpg')->get();
            $shape_ids = [];
            $subcategories_ids = [];
            foreach ($products_available as $product) {
                array_push($shape_ids, $product->shape_id);
                array_push($subcategories_ids, $product->subcategory_id);
            }
            $shapes = Shape::whereIn('id', $shape_ids)->get();
            $subcategories = Subcategory::whereIn('id', $subcategories_ids)->get();
        }

        $new_products = (!isset(request()->accessory) || request()->accessory == 'ALL') ? $new_products : $new_products->where('accessory_id', $accessory->id);

        if (isset(request()->gem_shape) && request()->gem_shape != 'ALL') {
            $gem_shape = (App::isLocale('ar')) ? Shape::where('arabic_name', request()->gem_shape)->first() : Shape::where('name', request()->gem_shape)->first();
            $products_available = Product::where('shape_id', $gem_shape->id)->whereIn('category_id', [$category->id, $both->id])->where('main_image', '!=', 'default.jpg')->get();
            $accessories_ids = [];
            $subcategories_ids = [];
            foreach ($products_available as $product) {
                array_push($accessories_ids, $product->accessory_id);
                array_push($subcategories_ids, $product->subcategory_id);
            }
            $accessories = Accessory::whereIn('id', $accessories_ids)->get();
            $subcategories = Subcategory::whereIn('id', $subcategories_ids)->get();
        }

        $new_products = (!isset(request()->gem_shape) || request()->gem_shape == 'ALL') ? $new_products : $new_products->where('shape_id', $gem_shape->id);

        //forLocalAndGlobalProducts
        $new_products = (!isset(request()->local) || request()->local == 'ALL') ? $new_products : $new_products->where('country_code', request()->local);

        //$filterRange = (request()->has('filter_price')) ? request()->filter_price : 12;

        $new_products = $new_products->where('main_image', '!=', 'default.jpg')->where('in_auction', 0)->where('archive', 0)->get()->sortByDesc('quantity')->sortByDesc('created_at');

        $zero_products = array();
        $random_products = array();
        foreach ($new_products as $product) {
            $product->quantity <= 0 ? array_push($zero_products, $product) : array_push($random_products, $product);
            if (Auth::check()) {
                $wish = Wish::where('user_id', Auth::user()->id)->where('product_id', $product->id)->first();
                if ($wish) {
                    $product['wished'] = 1;
                } else {
                    $product['wished'] = 0;
                }
            } else {
                $product['wished'] = 0;
            }
        }
        if (shuffle($random_products)) {
            $new_products = array_merge($random_products, $zero_products);
        }

        $new_products = $this->paginate($new_products)->setPath('/index');
        if (App::isLocale('ar')) {
            $currencies = Currency::all()->pluck('arabic_name', 'name')->reverse();
        } else {
            $currencies = Currency::all()->pluck('name', 'name')->reverse();
        };

        // $played_videos=isset($_COOKIE[ 'welu_autoplay']) ? $_COOKIE[ 'welu_autoplay'] : array();
        // $played_videos=( @unserialize($played_videos) )  ? @unserialize($played_videos) : $played_videos;
        //           $video = Video::first();
        //           $video_id= $video->url;
        //           $played=( isset($played_videos[$video_id]) ) ? 1 : 0;
        //           $played_videos[$video_id]=1 ;
        //           setcookie( 'welu_autoplay' , serialize($played_videos) , time()+90000 , '/' );

        if (Auth::check()) {
            $i_want_to_recommend = 20;
            $recommendations = [];
            $reco_products = [];

            $user = User::find(Auth::user()->id);
            $views = View::where('user_id', $user->id)->pluck('product_id');
            $products = Product::whereIn('id', $views)->get();
            $list_sub_wink = [];
            $all_input_for_suggestions = $products->count();
            foreach ($products as $one) {
                $list_sub_wink[] = $one->subcategory_id;
            }
            $list_sub_wink_with_count = array_count_values($list_sub_wink);
            foreach ($list_sub_wink_with_count as $key => $value) {
                $id = $key;
                //$current_subcategory = Subcategory::find($id);
                $count_suggestions_for_this_category = $value;
                $x = round(($i_want_to_recommend * $count_suggestions_for_this_category) / $all_input_for_suggestions);

                $category = Category::where('name', request()->g)->get()->first();
                $both = Category::where('name', 'Both')->get()->first();
                if (request()->g == 'Men' || request()->g == 'Women') {
                    $recommendations = Product::inRandomOrder()->where('subcategory_id', $id)->whereIn('category_id', [$category->id, $both->id]);
                    $recommendations = $recommendations->take($x)->latest()->where('in_auction', 0)->where('archive', 0)->paginate(12);
                } else {
                    $recommendations = Product::inRandomOrder()->where('subcategory_id', $id)->where('category_id', $category->id)->take($x)->get();
                }
                foreach ($recommendations as $recommendation) {
                    $reco_products[] = $recommendation;
                }
            }
            //return $reco_products;

            $reco_products = collect($reco_products);
            $recommended_products = $reco_products->forPage(0, 3);
            $recommended_products->all();
        }

        //best seller and mostly viewed products
        $best_seller = Product::orderBy('num_of_orders', 'desc')->where('archive', 0)->first();

        $mostly_viewed = View::groupBy('product_id')
            ->orderBy('count', 'desc')
            ->get(['product_id', DB::raw('count(product_id) as count')]);
        // $mostly_viewed_product = Product::find($mostly_viewed->first()->product_id);

        return view('shop.index', compact('new_products', 'categories', 'subcategories', 'show_all_subcategorys', 'currencies', 'video_id', 'played', 'played_videos', 'video', 'accessories', 'pp', 'recommended_products', 'best_seller', 'mostly_viewed_product', 'shapes'));
    }

    public function allVendors()
    {
        $vendors = Vendor::all();
        return view('shop.vendors', compact('vendors'));
    }
    public function getVendor($id)
    {

        $vendor = Vendor::find($id);
        if ($vendor) {
            $products = $vendor->products;
            $products = Product::where([
                'vendor_id' => $id,
                'archive' => 0,
            ])->paginate(12);

            $page_title = $vendor->vendor_name . ' ' . 'gems store' . '-' . 'Luxgems';
            return view('shop.vendor', compact('vendor', 'products', 'page_title'));
        }
        abort(404);
    }

    public function getCategory($id)
    {
        $category = Category::find($id);
        if ($category) {
            $subcategories = $category->subcategories;
            $both = Category::where('name', 'Both')->get()->first();
            //$products = $category->products()->paginate(12);
            $products = Product::whereIn('category_id', [$category->id, $both->id])->paginate(12);
            return view('shop.category', compact('category', 'subcategories', 'products'));
        }
        abort(404);
    }
    public function getSubcategory($id)
    {
        $subcategory = Subcategory::find($id);
        if ($subcategory) {
            $subcategories = $subcategory->siblings();
            $products = $subcategory->products()->paginate(12);
            $suppliers = $subcategory->supplier;

            return view('shop.subcategory', compact('subcategory', 'subcategories', 'products', 'suppliers', 'id'));
        }
        abort(404);
    }
    public function getProduct(Request $request, $id, $slug = null)
    {
        $curr = request()->c;

        if (isset($request['affiliate'])) {

            $slug = explode('/', $request['affiliate']);
            $affiliate = User::where('slug', $slug[0])->first();
            if ($affiliate) {
                $link = Link::where('slug', $slug[1])->where('user_id', $affiliate->id)->where('product_id', $id)->first();

                $old_visit = Visit::where('link_id', $link->id)->where('product_id', $id)->where('user_device_ip', request()->ip())->first();
                if (!isset($old_visit)) {
                    $visit = Visit::create([
                        'link_id' => $link->id,
                        'product_id' => $link->product->id,
                        'user_device_ip' => request()->ip(),
                    ]);
                    $link->visits = $link->visits + 1;
                    $link->save();
                }
            }
        }

        $product = Product::where([
            'id' => $id,
            'archive' => 0,
        ])
            ->where('main_image', '!=', 'default.jpg')->first();
        if ($product) {
            $vendor = Vendor::where('id', $product->vendor_id)->get()->first();
            $categories = Category::all();
            $subcategories = Subcategory::all();

            if (Auth::check()) {
                $view = View::where('user_id', Auth::user()->id)->where('product_id', $product->id)->first();
                if (empty($view)) {
                    $view = View::create([
                        'user_id' => Auth::user()->id,
                        'product_id' => $product->id,
                    ]);
                }
            }
            $related_products = Product::orderBy(DB::raw('RAND()'))->take(8)->where('subcategory_id', $product->subcategory_id)->where('id', '!=', $id)->where('archive', 0)->where('in_auction', 0)
                ->where('main_image', '!=', 'default.jpg')->get();
            if (count($related_products) == 0) {
                $related_products = Product::orderBy(DB::raw('RAND()'))->take(8)->where('category_id', $product->category_id)
                    ->where('id', '!=', $id)
                    ->where('main_image', '!=', 'default.jpg')
                    ->where('archive', 0)->where('in_auction', 0)->get();
            }
            if (Auth::check()) {
                $wish = Wish::where('user_id', Auth::user()->id)->where('product_id', $id)->first();
                if ($wish) {
                    $wishedBefore = 1;
                } else {
                    $wishedBefore = 0;
                }
            }
            $reviews = Review::where('product_id', $id)->latest()->get();

            //best seller and mostly viewed products
            $best_seller = Product::orderBy('num_of_orders', 'desc')->where('archive', 0)->first();

            $mostly_viewed = View::groupBy('product_id')
                ->orderBy('count', 'desc')
                ->get(['product_id', DB::raw('count(product_id) as count')]);
            // $mostly_viewed_product = Product::find($mostly_viewed->first()->product_id);

            //SEO
            $page_title = $product->name . ' ' . $product->subcategory->name;
            $page_description = $page_title . ' ' . str_limit($product->description, 150);

            $shares = Share::page($product->path() . getRequest())->facebook()->twitter()->linkedin();
            // $twitter = Share::currentPage()->twitter();
            // $linkedin = Share::currentPage()->linkedin();
            $product_imgs = $product->all_images_paths();
            return view('shop.product', compact('product_imgs', 'product', 'categories', 'subcategories', 'vendor', 'related_products', 'wishedBefore', 'reviews', 'best_seller', 'mostly_viewed_product', 'page_title', 'page_description', 'shares'));
        }
        abort(404);
    }
    public function postOrder(Request $request)
    {
        $this->validate($request, [
            'quantity' => 'integer|min:1',
            'product_id' => 'required|exists:products,id',
        ]);
        $email = Auth::user()->email;
        $product = Product::find($request['product_id']);
        if ($product->archive == 0) {
            if ($request->quantity <= $product->quantity) {
                $orders = Auth::user()->orders;
                $already_found = [];
                $price_without_currency = filter_var($product->price, FILTER_SANITIZE_NUMBER_INT);
                if (count($orders) > 0) {
                    foreach ($orders as $order) {
                        if ($order->product_id == $request->product_id) {
                            $cart = Cart::where(['product_id' => $request->product_id, 'quantity' => -$order->quantity])->first();
                            $quantity = $request->quantity + $order->quantity;
                            $order->quantity = $quantity;
                            if (isset($product->discount) && $product->discount != 0) {
                                $discount_without_currency = explode(' ', $product->discount);
                                $discount_without_currency = json_decode($discount_without_currency[0]);
                                if ($discount_without_currency != 0) {
                                    $order->update([
                                        'price' => $discount_without_currency * $quantity,
                                    ]);
                                } else {
                                    $order->price = $price_without_currency * $quantity;
                                }
                            }
                            $order->save();
                            $cart->quantity = -$order->quantity;
                            $cart->save();
                            array_push($already_found, 'found');
                            $name = Auth::user()->name;
                            $bill_id = $order->bill_id;
                            $created_at = $order->created_at;
                            $data = array('email' => Auth::user()->email, 'subject' => "Expected order");

                            if ($email && $email != '') {
                                Mail::send('shop.orderEmail', ['name' => $name, 'bill_id' => $bill_id, 'created_at' => $created_at], function ($message) use ($data) {
                                    $message->from('me@gmail.com', 'Luxgems');
                                    $message->to($data['email']);
                                    $message->subject($data['subject']);
                                });
                            }
                            if ($product->quantity == 0) {
                                $product->status = 0;
                            }
                            $product->save();
                            return response()->json("order added", 200);
                        }
                    }
                }

                if (count($already_found) == 0) {
                    $new_order = Order::create([
                        'user_id' => Auth::user()->id,
                        'product_id' => $request['product_id'],
                        'quantity' => $request['quantity'],
                        'bill_id' => rand(),
                        'price' => $price_without_currency * $request['quantity'],
                    ]);
                    $new_cart = Cart::create([
                        'product_id' => $product->id,
                        'vendor_id' => $product->vendor_id,
                        'store_id' => $product->store_id,
                        'quantity' => -$request['quantity'],
                        'reason' => 'order',
                    ]);
                    if (isset($product->discount) && $product->discount != 0) {
                        $discount_without_currency = explode(' ', $product->discount);
                        $discount_without_currency = json_decode($discount_without_currency[0]);
                        if ($discount_without_currency != 0) {
                            $new_order->update([
                                'price' => $discount_without_currency * $request['quantity'],
                            ]);
                        }
                    }
                    if ($request->has('affiliate')) {
                        $slug = explode('/', $request['affiliate']);
                        $link = Link::where('slug', $slug[1])->first();

                        $new_order->update([
                            'link_id' => $link->id,
                        ]);
                    }

                    $name = Auth::user()->name;
                    $bill_id = $new_order->bill_id;
                    $created_at = $new_order->created_at;
                    $data = array('email' => Auth::user()->email, 'subject' => "Expected order");
                    if ($email && $email != '') {
                        Mail::send('shop.orderEmail', ['name' => $name, 'bill_id' => $bill_id, 'created_at' => $created_at], function ($message) use ($data) {
                            $message->from('me@gmail.com', 'Luxgems');
                            $message->to($data['email']);
                            $message->subject($data['subject']);
                        });
                    }
                }
                if ($product->quantity == 0) {
                    $product->status = 0;
                }
                $product->save();
                return response()->json("order added", 200);
            } else {
                return response()->json("check your quantity", 500);
            }
        } else {
            return response()->json('this product has been archived', 500);
        }
    }
    public function getCart()
    {
        //$orders = Auth::user()->orders;//->with(['products']);
        $orders = Order::where('user_id', Auth::user()->id)->latest()->get();
        $checkout_amount = 0;
        $to_Currency = request()->c;
        if ($to_Currency) {
            if ($to_Currency !== 'GBP') {
                $rate = Swap::latest('GBP/' . $to_Currency, ['cache_ttl' => 120]);
                $rate = round($rate->getValue(), 2);
                $shipment = $rate * 10;
            } else {
                $shipment = 10;
            }
        } else {
            $shipment = 10;
        }
        if (count($orders->count() > 0)) {
            foreach ($orders as $order) {
                if ($order->product) {
                    if (isset($order->product->discount) && $order->product->discount != 0) {
                        $discount_without_currency = explode(' ', $order->product->discount);
                        $order['product_price_without_currency'] = json_decode($discount_without_currency[0]);
                        $checkout_amount += $order->quantity * json_decode($discount_without_currency[0]);
                    } else {
                        $price_without_currency = explode(' ', $order->product->price);
                        $order['product_price_without_currency'] = json_decode($price_without_currency[0]);
                        $checkout_amount += $order->quantity * json_decode($price_without_currency[0]);
                    }
                }
            }
        }

        return view('shop.cart', compact('orders', 'checkout_amount', 'shipment'));
    }
    public function getRemoveOrder($id)
    {
        $order = Order::find($id);
        if ($order) {
            if ($order->user_id == Auth::user()->id) {

                $product = Product::where('id', $order->product_id)->first();
                //$product->quantity = $product->quantity + $order->quantity;

                $cart = Cart::create([
                    'product_id' => $product->id,
                    'vendor_id' => $product->vendor_id,
                    'store_id' => $product->store_id,
                    'quantity' => $order->quantity,
                    'reason' => 'user remove order',
                ]);
                /*$product->update([
                'quantity' => $product->quantity + $order->quantity,
                ]);*/

                $order->forcedelete();
                return back();
            } else {
                return back();
            }
        }
        abort(404);
    }

    public function buy()
    {

        $orders = Auth::user()->orders;
        if (count($orders) <= 0) {
            abort(505);
        } //->with(['products']);
        $checkout_amount = 0;
        if (count($orders->count())) {
            foreach ($orders as $order) {
                $price_without_currency = explode(' ', $order->product->price);
                $price_without_currency = json_decode($price_without_currency[0]);
                $checkout_amount += $order->quantity * $price_without_currency;
            }
        }

        $old_purchase = Purchase::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->first();

        //return redirect('cart' . getRequest());
        return view('shop.buyer_details', compact('checkout_amount', 'old_purchase'));
    }

    public function postBuy(Request $request)
    {
        $this->validate($request, [
            'delivery_address' => 'required|max:255',
            'billing_address' => 'required|max:255',
            'receptor_mobile' => 'required|digits_between:1,30|numeric',
            'buyer_mobile' => 'required|digits_between:1,30|numeric',
            'receptor_name' => 'required|max:255',
        ]);
        $orders = Auth::user()->orders; //->with(['products']);
        if (count($orders)) {
            $checkout_amount = 0;
        }
        $shipment = 10;
        $promo_code = false;
        if (isset($request->code) && $request->code !== '') {
            $user = Auth::user();
            $now = Carbon::now()->toDateTimeString();
            $coupon = Coupon::where('code', $request->code)->where('expiry_date', '>', $now)->first();
            if (!$coupon) {
                return back()->withErrors('invalid promocode');
            }
            if ($user->checkPromoCode($coupon)) {
                $checkout_amount = $user->getTotalAfterPromo($coupon);
            } else {
                return back()->withErrors('invalid promocode');
            }
            $promo_code = true;
        } else {
            if (count($orders->count())) {
                foreach ($orders as $order) {
                    if (isset($order->product->discount) && $order->product->discount != 0) {
                        $discount_without_currency = explode(' ', $order->product->discount);
                        $order['product_discount_without_currency'] = json_decode($discount_without_currency[0]);
                        $checkout_amount += $order->quantity * json_decode($discount_without_currency[0]);
                    } else {
                        $price_without_currency = explode(' ', $order->product->price);
                        $order['product_price_without_currency'] = json_decode($price_without_currency[0]);
                        $order['product_discount_without_currency'] = 0;
                        $checkout_amount += $order->quantity * json_decode($price_without_currency[0]);
                    }
                    //return $order;
                }
            }
            $checkout_amount = $shipment + $checkout_amount;
        }

        $purchase = Purchase::where([
            'user_id' => Auth::user()->id,
            'delivery_address' => $request['delivery_address'],
            'billing_address' => $request['billing_address'],
            'receptor_mobile' => $request['receptor_mobile'],
            'buyer_mobile' => $request['buyer_mobile'],
            'receptor_name' => $request['receptor_name'],
            'price' => $checkout_amount,
            'purchase_status' => 'pending',
            'note' => $request['note'],
            'shipment' => 10,
            'method' => null,
        ])->first();
        if (!$purchase) {
            $purchase = Purchase::create([
                'user_id' => Auth::user()->id,
                'delivery_address' => $request['delivery_address'],
                'billing_address' => $request['billing_address'],
                'receptor_mobile' => $request['receptor_mobile'],
                'buyer_mobile' => $request['buyer_mobile'],
                'receptor_name' => $request['receptor_name'],
                'price' => $checkout_amount,
                'purchase_status' => 'pending',
                'note' => $request['note'],
                'bill_id' => rand(),
                'shipment' => 10,
            ]);
        }

        $user = User::find(Auth::user()->id);
        $user->update(['customerOrNot' => 1]);

        ini_set("soap.wsdl_cache_enabled", "0");
        ini_set('user_agent', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:20.0)Gecko/20100101 Firefox/20.0');
        $merchant_id = 'atwltd';
        $encryption_key = 'alqawareer';
        $amount = $checkout_amount; // this value will be posted from the above HTML
        $currency = 'usd';
        $display_text = 'Pay';
        $language = 'en';
        //session()->put('session_id', 'anony'.rand(0000,9999));
        $session_id = 'seses';
        $txt1 = "item";
        $testmode = 0;
        $txt2 = '';
        $txt3 = '';
        $txt4 = '';
        $txt5 = '';
        $service_name = 'pay';
        $token = md5(strtolower($merchant_id) . ':' . $amount . ':' . strtolower($currency) . ':' . strtolower($session_id) . ':' . $encryption_key);
        //return $token;

        // CashU
        // $client = new SoapClient('https://sandbox.cashu.com/secure/payment.wsdl', array('trace' => true));
        // $request = $client->DoPaymentRequest($merchant_id, $token, $display_text, $currency, $amount, $language, $session_id, $txt1, $txt2, $txt3, $txt4, $txt5, $testmode, $service_name);
        // $tmp = strstr($request, '=');
        // $Transaction_Code = substr($tmp, 1);

        // PAY PAL INTEGRATION
        $paypalUrl = 'https://www.paypal.com/cgi-bin/webscr?x=ghghg';
        $paypalId = 'atw.mailserver@gmail.com';

        // $paypalUrl='https://www.sandbox.paypal.com/cgi-bin/webscr';
        // $paypalId='merchant@atw.com';

        // PayTabs
        // $paytabs = new PayTabs();
        // $paytabs->set_page_setting('title', 'ref number', 'USD', '127.0.0.1', 'English');
        // $paytabs->set_customer('mohamed', 'nabil', '002', '01001111111', 'mohamed_707073@yahoo.com');
        // $paytabs->add_item('Luxgems Order', $checkout_amount, '1');
        // $paytabs->set_address("Flat 3021 Manama Bahrain", "Manama", "Manama", "12345", "BHR");
        // $page = $paytabs->create_pay_page();
        // $payTabUrl = $page->payment_url;

        return view('shop.method', compact('promo_code', 'purchase', 'paypalUrl', 'paypalId', 'checkout_amount', 'orders', 'shipment'));

    }

    public function chooseDelivery(Request $request)
    {
        //return $request['price'];
        $purchase = Purchase::find($request['purchase_id']);
        $purchase->update([
            'method' => 'cash on delivery',
            'purchase_status' => 'pending',
        ]);

        $user = $purchase->user;

        $purchases = Purchase::where([
            'user_id' => $user->id,
            'method' => null,
        ])->forcedelete();

        $user->update([
            'points' => $user->points + $request['price'],
        ]);

        // $nexmo = app('Nexmo\Client');

        // $nexmo->message()->send([
        //     'to'   => '14845551244',
        //     'from' => '16105552344',
        //     'text' => 'Using the instance to send a message.'
        // ]);

        $orders = $user->orders;
        if (count($orders) <= 0) {
            abort(505);
        }
        foreach ($orders as $order) {
//to determine order cost(for affiliate)

            if (isset($order->link_id)) {
                $link = Link::find($order->link_id);
                $link->orders = (int) $link->orders + 1;
                $link->save();

            }
            //To know num of orders in the Purchase
            $order->update([
                'purchase_id' => $purchase->id,
            ]);

            $history = History::create([
                'user_id' => Auth::user()->id,
                'product_id' => $order->product->id,
                'order_status' => 'In Progress',
                'price' => $order->price,
                'quantity' => $order->quantity,
                'bill_id' => $order->bill_id,
                'order_id' => $order->id,
                'purchase_id' => $order->purchase_id,
                'country_code' => $order->product->country_code,
                // 'seller_id' => $order->product->vendor_id,
                // 'store_id' => $order->product->vendor_id,
            ]);

        }

//To know best seller product

        $num_of_product_orders = $user->orders->pluck('product_id');
        $products = Product::whereIn('id', $num_of_product_orders)->get();
        foreach ($products as $product) {
            $product->update([
                'num_of_orders' => $product->num_of_orders + 1,
            ]);
        }

        $num_of_product_orders = $user->orders()->delete();
        //$orders->delete();

        return redirect('/history');
    }

    public function recommended()
    {
        $i_want_to_recommend = 20;
        $recommendations = [];
        $reco_products = [];
        $user = User::find(Auth::user()->id);
        $views = View::where('user_id', $user->id)->pluck('product_id');
        $products = Product::whereIn('id', $views)->where('archive', 0)->get();
        $list_sub_wink = [];
        $all_input_for_suggestions = $products->count();
        foreach ($products as $one) {
            $list_sub_wink[] = $one->subcategory_id;
        }
        $list_sub_wink_with_count = array_count_values($list_sub_wink);
        foreach ($list_sub_wink_with_count as $key => $value) {
            $id = $key;
            //$current_subcategory = Subcategory::find($id);
            $count_suggestions_for_this_category = $value;
            $x = round(($i_want_to_recommend * $count_suggestions_for_this_category) / $all_input_for_suggestions);

            $category = Category::where('name', request()->g)->get()->first();
            $both = Category::where('name', 'Both')->get()->first();

            if (request()->g == 'Men' || request()->g == 'Women') {
                $recommendations = Product::inRandomOrder()->where('subcategory_id', $id)->where('archive', 0)->whereIn('category_id', [$category->id, $both->id]);
                $recommendations = $recommendations->take($x)->latest()->paginate(12);
            } else {
                $recommendations = Product::inRandomOrder()->where('subcategory_id', $id)->where('archive', 0)->where('category_id', $category->id)->take($x)->get();
            }

            foreach ($recommendations as $recommendation) {
                $reco_products[] = $recommendation;
            }

        }
        //return $reco_products;
        $reco_products = collect($reco_products);
        $recommended_products = $reco_products->forPage(0, 50);
        $recommended_products->all();

        //$reco_products = $reco_products->latest()->paginate(12);
        return view('shop.recommended', compact('products', 'recommended_products'));
    }

    public function auction()
    {
        $auctions_products = Auction::running()->get();
        return view('shop.auctions', compact('auctions_products'));
    }

    public function getAuctionProduct(Request $request, $id, $slug = null)
    {
        $auction = Auction::where('product_id', $id)->first();
        $results = AuctionTransaction::where('auction_id', $auction->id)->latest()->get();

        foreach ($results as $one) {
            $one['user'] = $one->user;
        }

        if (isset($auction->best_price)) {
            $best_user = $results->where('price', $auction->best_price)->first();
            $best_user_name = $best_user->user->name;
        }
        $curr = request()->c;
        $product = Product::find($id);
        //$auction = Auction::where('product_id',$id)->first();
        $categories = Category::all();
        $subcategories = Subcategory::all();

        return view('shop.auction', compact('product', 'categories', 'subcategories', 'auction', 'pusher', 'results', 'best_user_name'));
    }

    public function postAuction(Request $request)
    {

        $this->validate($request, [
            'price' => 'required|numeric|min:1',
        ]);

        $auction = Auction::find($request['auction_id']);
        if (!isset($auction->best_price)) {
            if ($request['price'] > $auction->start_price) {
                $auction->update([
                    'best_price' => $request['price'],
                ]);

                $auction_transaction = AuctionTransaction::create([
                    'auction_id' => $request['auction_id'],
                    'user_id' => Auth::user()->id,
                    'price' => $request['price'],
                ]);
            }

        } else {
            if ($request['price'] > $auction->best_price) {
                $auction->update([
                    'best_price' => $request['price'],
                ]);

                $auction_transaction = AuctionTransaction::create([
                    'auction_id' => $request['auction_id'],
                    'user_id' => Auth::user()->id,
                    'price' => $request['price'],
                ]);

            }
        }

        $price = $auction->best_price;
        $options = array(
            'cluster' => 'eu',
            'encrypted' => true,
        );
        $pusher = new Pusher\Pusher(
            '9d87d2397a79da6c6ff1',
            '08153304f2a1023fac6e',
            '380980',
            $options
        );

        $data['message'] = $price;
        $data['user_name'] = Auth::user()->name;
        $pusher->trigger('my-channel', 'my-event', $data);
        return back();
        //return redirect('/index'.'?gen='.$request['gen']);
    }

    public function getHistory(Request $request)
    {

        $all_purchases = Purchase::where('user_id', Auth::user()->id)->latest()->get();
        $purchases = [];
        foreach ($all_purchases as $purchase) {
            if (count($purchase->histories) > 0) {
                array_push($purchases, $purchase);
            }
        }
        //return $purchases;
        $to_Currency = request()->c;
        if ($to_Currency) {
            if ($to_Currency !== 'GBP') {
                $rate = Swap::latest('GBP/' . $to_Currency, ['cache_ttl' => 120]);
                $rate = round($rate->getValue(), 2);
                $shipment = $rate * 10;
            } else {
                $shipment = 10;
            }
        } else {
            $shipment = 10;
        }
        /*foreach($histories as $history){
        $order=Order::where('id',$history->order_id)->first();
        $purchase=Purchase::where('id',$order->purchase_id)->first();
        $history['purchase_bill_id']=$purchase->bill_id;
        }*/
//to know which page i redirect him
        if ($request->has('gen')) {
            $x = 1;
        } else {
            $x = 0;
        }

        return view('shop.history', compact('purchases', 'x', 'shipment'));
    }

    public function getRemoveHistory($id)
    {
        $history = History::find($id);
        if ($history) {
            $history->delete();
            return back();
        }
        abort(404);
    }

    public function getWishlist(Request $request)
    {

        $wishes = Wish::where('user_id', Auth::user()->id)->latest()->get();
        if ($request->has('gen')) {
            $x = 1;
        } else {
            $x = 0;
        }

        return view('shop.wishlist', compact('wishes', 'x'));
    }

    public function postWish(Request $request)
    {
        $exist = Wish::where('product_id', $request['product_id'])->where('user_id', Auth::user()->id)->first();
        $product = Product::where('id', $request->product_id)->first();
        if ($exist) {
            $exist->delete();
            return response()->json(['code' => 202, 'message' => $product->name . ' removed from your wishlist'], 200);
        } else {
            $wish = Wish::create([
                'user_id' => Auth::user()->id,
                'product_id' => $request['product_id'],
            ]);
            return response()->json(['code' => 200, 'message' => $product->name . ' added to your wishlist'], 200);
        }

        return redirect('/');
    }

    public function getRemoveWish($id)
    {
        $wish = Wish::find($id);
        if ($wish) {
            $deleted = $wish->delete();
            if ($deleted) {
                return response()->json('deleted', 200);
            } else {
                return response()->json('something went wrong', 500);
            }
        }
        abort(404);
    }

    public function postReview(Request $request)
    {

        $this->validate($request, [
            'review' => 'required|max:255',
            'product_id' => 'required|exists:products,id',
        ]);
        $review = new Review;
        $review->user_id = Auth::user()->id;
        $review->product_id = $request->product_id;
        $review->body = $request->review;
        $review->user_name = Auth::user()->name;
        $saved = $review->save();
        if ($saved) {
            $response = '<article style="position:relative;" id="' . $review->id . '">
            <big>' . $review->user_name . '</big>
            <hr style="margin-top:30px;">
            <p>' . $review->body . '</p>';
            if ($review->user_id == Auth::user()->id) {
                $response = $response . '<section id="' . $review->id . '" class="close1" data-href="' . route("remove.review", $review->id) . '"> </section>';
            } else {

            }
            $response = $response . '</article>';
            return response()->json($response, 200);
        } else {
            return response()->json('error', 500);
        }

    }

    public function getRemoveReview($id)
    {
        $review = Review::find($id);
        $review->delete();
        return back();
    }

//Digital products

    public function Digital()
    {
        $digital_products = DigitalProduct::all();
        return view('shop.digitals', compact('digital_products'));
    }

    public function getOneDigital($id)
    {

        $product = DigitalProduct::find($id);

        // PAY PAL INTEGRATION
        // $paypalUrl='https://www.paypal.com/cgi-bin/webscr';
        // $paypalId='atw.mailserver@gmail.com';

        $paypalUrl = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
        $paypalId = 'merchant@atw.com';
        return view('shop.digital', compact('product', 'paypalUrl', 'paypalId'));

    }

    public function downloadDigitalProduct(Request $request)
    {

        $file = public_path() . "/digital_products/" . $request->file;

        $headers = array(
            'Content-Type: application/pdf',
        );

        return response()->download($file, $request->name . '.pdf', $headers);
    }

//FORGOT PASSWORD
    public function getForgot()
    {
        return view('shop.forgot');
    }

    public function postForgot(Request $request)
    {

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $reset = PasswordReset::where(['user_id' => $user->id])->first();
            if (!$reset) {
                $contactEmail = $request['email'];
                $subject = "Luxgems Reset Password";
                $code = str_random(6);
                Mail::send('shop.resetCode', ['code' => $code], function ($message) use ($contactEmail, $subject) {
                    $message->from('Luxgems@gmail.com', 'Luxgems');
                    $message->to($contactEmail);
                    $message->subject($subject);
                });

                $now = Carbon::now();
                $reset = passwordReset::create([
                    'user_id' => $user->id,
                    'code' => $code,
                    'expiry_time' => $now->addHours(1),
                ]);
            } else {
                $contactEmail = $request['email'];
                $subject = "Luxgems Reset Password";
                $code = $reset->code;
                Mail::send('shop.resetCode', ['code' => $code], function ($message) use ($contactEmail, $subject) {
                    $message->from('Luxgems@gmail.com', 'Luxgems');
                    $message->to($contactEmail);
                    $message->subject($subject);
                });
            }
            return view('shop.enterResetCode', compact('user'))->with('message', 'check your email to get your code');
        } else {
            return back()->with('message', 'That e-mail address or username does not have an associated user account. Are you sure you have registered?');

        }
    }

    public function checkResetCode(Request $request)
    {
        $code = passwordReset::running()->where('user_id', $request->id)->orderBy('id', 'desc')->first();
        $user = User::find($request->id);
        if ($code->code == $request->code) {
            return view('shop.passwordReset', compact('user'));
        } else {
            return back()->with('message', trans('layout.Wrong_Credinticals'));
        }
    }

    public function resetPassword(Request $request)
    {

        $this->validate($request, [
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6',
            'id' => 'required',
        ]);
        if ($request->password === $request->password_confirmation) {
            $user = User::find($request->id);
            if (!$user) {
                abort(404);
            }
            $user->fill([
                'password' => Hash::make($request->password),
            ])->save();
            Auth::login($user, true);
            return response()->json('password changed', 200);
        } else {
            return response()->json('check your password confirmation', 500);
        }
    }

    public function EditQuantity(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:orders,id',
            'quantity' => 'integer|min:1',
        ]);

        $order = Order::find($request->id);

        $product = Product::find($order->product->id);
        $price = $order->price / $order->quantity;

        /*$product->quantity = $product->quantity + $order->quantity;
        $product->save();*/

        $cart = Cart::where('product_id', $order->product->id)->where('quantity', -$order->quantity)->where('reason', 'order')->latest()->first();

        $cart->update([
            'quantity' => -$request['quantity'],
        ]);

        $order->update([
            'quantity' => $request['quantity'],
            'price' => $price * $request->quantity,
        ]);

        $product->quantity = $product->quantity - $request['quantity'];
        if ($product->quantity == 0) {
            $product->status = 0;
        }
        $product->save();

        return back();
    }

    //facebook login

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();

    }

    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
        } catch (Exception $e) {
            return redirect('/facebook');
        }
        $authUser = $this->findOrCreateUser($user);

        Auth::login($authUser, true);

        return redirect('/');
    }

    private function findOrCreateUser($facebookUser)
    {
        $authUser = User::where('facebook_id', $facebookUser->id)
            ->orWhere('email', $facebookUser->email)
            ->first();

        if ($authUser) {
            return $authUser;
        }

        $user = User::create([
            'name' => $facebookUser->name,
            'email' => $facebookUser->email,
            'facebook_id' => $facebookUser->id,
            //'avatar' => $facebookUser->avatar,
            'api_token' => str_random(20),
            'role' => 'user',
            'points' => 1000,
        ]);
        return $user;
    }

    public function reOrder(Request $request)
    {

        $product = Product::find($request['product_id']);
        $cart = Cart::create([
            'product_id' => $product->id,
            'vendor_id' => $product->vendor_id,
            'store_id' => $product->store_id,
            'quantity' => -$request['quantity'],
            'reason' => 're-order',
        ]);
        $product->update([
            'quantity' => $product->quantity,
        ]);
        if ($product->quantity == 0) {
            $product->status = 0;
        }
        $product->save();

        $price_without_currency = filter_var($product->price, FILTER_SANITIZE_NUMBER_INT);
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'product_id' => $request['product_id'],
            'quantity' => $request['quantity'],
            'bill_id' => rand(),
            'price' => $price_without_currency * $request['quantity'],
        ]);
        if (isset($product->discount) && $product->discount != 0) {
            $discount_without_currency = explode(' ', $order->product->discount);
            $discount_without_currency = json_decode($discount_without_currency[0]);
            $order->update([
                'price' => $discount_without_currency * $request['quantity'],
            ]);
        }

        $name = Auth::user()->name;
        $bill_id = $order->bill_id;
        $created_at = $order->created_at;
        $data = array('email' => Auth::user()->email, 'subject' => "Expected order");
        $email = Auth::user()->email;
        if ($email && $email != '') {
            Mail::send('shop.orderEmail', ['name' => $name, 'bill_id' => $bill_id, 'created_at' => $created_at], function ($message) use ($data) {
                $message->from('me@gmail.com', 'Luxgems');
                $message->to($data['email']);
                $message->subject($data['subject']);
            });
        }

        $orders = Auth::user()->orders; //->with(['products']);
        $checkout_amount = 0;
        $shipment = 10;
        if (count($orders->count())) {
            foreach ($orders as $order) {
                /*$price_without_currency = explode(' ', $order->product->price);
                $discount_without_currency = explode(' ', $order->product->discount);
                $order['product_price_without_currency'] = json_decode($price_without_currency[0]);
                $order['product_discount_without_currency'] = json_decode($discount_without_currency[0]);
                $checkout_amount += $order->quantity * json_decode($price_without_currency[0]);*/
                if (isset($order->product->discount) && $order->product->discount != 0) {
                    $discount_without_currency = explode(' ', $order->product->discount);
                    $discount_without_currency = json_decode($discount_without_currency[0]);
                    $checkout_amount += $order->quantity * $discount_without_currency;
                } else {
                    $checkout_amount += $order->quantity * $order->product->price;
                }
            }
        }

        $old_purchase = Purchase::where('user_id', Auth::user()->id)->first();
        $purchase = Purchase::create([
            'user_id' => Auth::user()->id,
            'purchaser' => Auth::user()->name,
            'purchaser' => Auth::user()->name,
            'delivery_address' => $old_purchase->delivery_address,
            'billing_address' => $old_purchase->billing_address,
            'receptor_mobile' => $old_purchase->receptor_mobile,
            'buyer_mobile' => $old_purchase->buyer_mobile,
            'receptor_name' => $old_purchase->receptor_name,
            'price' => $checkout_amount + 10,
            'purchase_status' => 'pending',
            'note' => $old_purchase->note,
            'bill_id' => rand(),
            'shipment' => 10,
        ]);
        $checkout_amount = $checkout_amount + 10;

        $user = User::find(Auth::user()->id);
        $user->update(['customerOrNot' => 1]);

        ini_set("soap.wsdl_cache_enabled", "0");
        ini_set('user_agent', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:20.0)Gecko/20100101 Firefox/20.0');
        $merchant_id = 'atwltd';
        $encryption_key = 'alqawareer';
        $amount = $checkout_amount; // this value will be posted from the above HTML
        $currency = 'usd';
        $display_text = 'Pay';
        $language = 'en';
        //session()->put('session_id', 'anony'.rand(0000,9999));
        $session_id = 'seses';
        $txt1 = "item";
        $testmode = 0;
        $txt2 = '';
        $txt3 = '';
        $txt4 = '';
        $txt5 = '';
        $service_name = 'pay';
        $token = md5(strtolower($merchant_id) . ':' . $amount . ':' . strtolower($currency) . ':' . strtolower($session_id) . ':' . $encryption_key);
        //return $token;
        $client = new SoapClient('https://sandbox.cashu.com/secure/payment.wsdl', array('trace' => true));
        $request = $client->DoPaymentRequest($merchant_id, $token, $display_text, $currency, $amount, $language, $session_id, $txt1, $txt2, $txt3, $txt4, $txt5, $testmode, $service_name);
        $tmp = strstr($request, '=');

        $Transaction_Code = substr($tmp, 1);

        // PAY PAL INTEGRATION
        $paypalUrl = 'https://www.paypal.com/cgi-bin/webscr';
        $paypalId = 'atw.mailserver@gmail.com';

        //$paypalUrl='https://www.sandbox.paypal.com/cgi-bin/webscr';
        //$paypalId='merchant@atw.com';

        /*$paytabs = new PayTabs();

        $paytabs->set_page_setting('title', 'ref number', 'USD', '127.0.0.1', 'English');

        $paytabs->set_customer('mohamed', 'nabil', '002', '01001111111', 'mohamed_707073@yahoo.com');
        $paytabs->add_item('Luxgems Order', $checkout_amount, '1');

        $paytabs->set_address("Flat 3021 Manama Bahrain", "Manama", "Manama", "12345", "BHR");
        $page = $paytabs->create_pay_page();

        $payTabUrl = $page->payment_url;*/

        return view('shop.method', compact('purchase', 'paypalUrl', 'paypalId', 'Transaction_Code', 'payTabUrl', 'checkout_amount', 'orders', 'shipment'));

    }

    public function getreOrder()
    {
        abort(404);
    }

    public function choosePaypal(Request $request)
    {
        // return $request->purchase_id;
        $purchase = Purchase::find($request['purchase_id']);
        $purchase->update([
            'method' => 'Paypal',
            'purchase_status' => 'pending',
        ]);

        $user = $purchase->user;

        $purchases = Purchase::where([
            'user_id' => $user->id,
            'method' => null,
        ])->forcedelete();

        $user->update([
            'points' => $user->points + $purchase->price,
        ]);

        $orders = $user->orders;
        foreach ($orders as $order) {
//to determine order cost(for affiliate)

            if (isset($order->link_id)) {
                $link = Link::find($order->link_id);
                $orders = (int) $link->orders;
                $new_orders = $orders + 1;
                $link->orders = $new_orders;
                $link->save();

            }
            //To know num of orders in the Purchase
            $order->update([
                'purchase_id' => $purchase->id,
            ]);

            $history = History::create([
                'user_id' => Auth::user()->id,
                'product_id' => $order->product->id,
                'order_status' => 'In Progress',
                'purchase_id' => $order->purchase_id,
                'price' => $order->price,
                'quantity' => $order->quantity,
                'bill_id' => $order->bill_id,
                'order_id' => $order->id,
            ]);

        }

//To know best seller product

        $num_of_product_orders = $user->orders->pluck('product_id');
        $products = Product::whereIn('id', $num_of_product_orders)->get();
        foreach ($products as $product) {
            $product->update([
                'num_of_orders' => $product->num_of_orders + 1,
            ]);
        }
        $num_of_product_orders = $user->orders()->delete();
        return redirect('/');
    }

    /**
     * Gera a paginação dos itens de um array ou collection.
     *
     * @param array|Collection      $items
     * @param int   $perPage
     * @param int  $page
     * @param array $options
     *
     * @return LengthAwarePaginator
     */
    public function paginate($items, $perPage = 12, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

}
