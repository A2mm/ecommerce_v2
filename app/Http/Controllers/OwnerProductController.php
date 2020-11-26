<?php

namespace App\Http\Controllers;

// use App\Accessory;
use App\Ad;
use App\Cart;
use App\Category;
use App\Currency;
use App\Country;
use App\Configuration;
use App\CategoryOnline;
use Carbon\Carbon;
use App\Product;
use App\Order;
// use App\Shape;
use App\Store;
use App\Barcode;
use App\Subcategory;
use App\AttributeProduct;
use App\Vendor;
use App\ProductStoreQuantity;
use Illuminate\Http\Request;
use \App\Image;
use Auth;
use App\Usertypeprice;
use App\Usertype;
use App\History;
use Session;
use App\Exports\ProductsExport;
use App\Exports\ProductPricesExport;
use App\Exports\RefundsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\allRefundsExport;
use App\Tag;

class OwnerProductController extends Controller
{
    public function getShowAll(Request $request)
    {
        if (!$request->has('search_index') || $request->search_index == '')
        {
            $search_index = '';
            $products = Product::where('archive', 0)->paginate(10);
        }
        else
        {
            $search_index = trim($request->search_index);
            if (empty($search_index))
            {
              $search_index = '';
              $products = Product::where('archive', 0)->paginate(10);
               //return redirect()->back();
            }
            else
            {
                  $products = Product::where('archive', 0)->where('name', 'LIKE', "%{$search_index}%")
                                                        ->orWhere('unique_id', 'LIKE', "%{$search_index}%")
                                                        ->orWhere('weight', 'LIKE', "%{$search_index}%")
                                                        ->orWhere('created_at', 'LIKE', "%{$search_index}%")
                                                        ->orWhereHas('category', function($q) use($search_index)
                                                            {
                                                                $q->where('name', 'like', '%'.$search_index.'%');
                                                            })
                                                        ->orWhereHas('subcategory', function($q) use($search_index)
                                                            {
                                                                $q->where('name', 'like', '%'.$search_index.'%');
                                                            })
                                                        ->paginate(10);
            }

        }

        return view('owner_dashboard.products.all', compact('products', 'search_index'));
    }

    public function getShowAll_ajax(Request $request)
    {
        if ($request->ajax()) {
            $search_index =  $request->get('search_index');
            if ($search_index == '') {
                $products = Product::where('archive', 0)->paginate(10);
            }
            else
            {
                $products = Product::where('archive', 0)->where('name', 'LIKE', "%{$search_index}%")
                                                        ->orWhere('unique_id', 'LIKE', "%{$search_index}%")
                                                        ->orWhere('weight', 'LIKE', "%{$search_index}%")
                                                        ->orWhere('created_at', 'LIKE', "%{$search_index}%")
                                                        ->orWhereHas('category', function($q) use($search_index)
                                                            {
                                                                $q->where('name', 'like', '%'.$search_index.'%');
                                                            })
                                                        ->orWhereHas('subcategory', function($q) use($search_index)
                                                            {
                                                                $q->where('name', 'like', '%'.$search_index.'%');
                                                            })
                                                        ->paginate(10);
            }
        }

         return view('owner_dashboard.products.table_body', compact('products'));
    }

    public function getShowArchived()
    {
        $products = Product::where('archive', 1)->paginate(10);
        return view('owner_dashboard.products.archive', compact('products'));
    }

    public function getShowMovements(Request $request, $product_id)
    {
      /*  $movements = ProductStoreQuantity::where('product_id', $product_id)
        ->with('product')
        ->with('store')
        ->orderBy('created_at', 'desc')
        ->paginate(10);
        return view('owner_dashboard.products.movements', compact('movements'));*/
        /*
        $movements = ProductStoreQuantity::where('product_id', $product_id)
        ->with('product')
        ->with('store')
        ->where('created_at', '>=', $request->from)
        ->where('created_at', '<=', $request->to)
        //->whereBetween('created_at', [$request->from, $request->to])->get();
        ->paginate(25);*/
       // return view('owner_dashboard.products.movements', compact('movements'));

         if (!$request->has('search_index') || $request->search_index == '')
        {
            $search_index = '';
            $movements = ProductStoreQuantity::where('product_id', $product_id)
                                            ->where('quantity', '!=', 0)
                                            ->with('product')
                                            ->with('store')
                                           ->orderBy('created_at', 'DESC')
                                           ->paginate(10);
        }
        else
        {
            $search_index = trim($request->search_index);
            if (empty($search_index))
            {
              $search_index = '';
              $movements = ProductStoreQuantity::where('product_id', $product_id)
                                            ->where('quantity', '!=', 0)
                                            ->with('product')
                                            ->with('store')
                                           ->orderBy('created_at', 'DESC')
                                           ->paginate(10);
               // return redirect()->back();
            }
            else
            {
               $movements = ProductStoreQuantity::where('product_id', $product_id)
                                          ->where('quantity', '!=', 0)
                                          ->WhereHas('store', function($q) use($search_index)
                                                            {
                                                                $q->where('name', 'like', '%'.$search_index.'%');
                                                            })
                                         ->orderBy('created_at', 'DESC')
                                         ->paginate(10);
            }

        }
        $prod = Product::select('name')->where('id', $product_id)->first();

        return view('owner_dashboard.products.movements', compact('movements', 'search_index', 'product_id', 'prod'));
    }

    public function getView($id)
    {
        $product = Product::find($id);
        if ($product) {
            $id = $product->id;
            $prices = Usertypeprice::where('product_id', $id)->get();
            return view('owner_dashboard.products.view', compact('product', 'prices'));
        }
        abort(404);
    }

    public function archiveToggle($id)
    {
        $product = Product::find($id);
        $orders  = Order::where('product_id' , $id)->get();
        if ($orders->count() > 0) {
          foreach ($orders as $order) {
            $order->delete();
          }
        }
        if ($product) {
            if ($product->archive == 0) {
                $product->archive = 1;
            } else {
                $product->archive = 0;
            }
            $product->save();
            return back()->withMessage(__('translations.product_edited_successfuly'));
        }
        abort(404);
    }

    // tags 
     public function alltags($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->withErrors('هذا المنتج غير موجود');
        }
        $tags    = Tag::where('product_id', $id)->get();
        return view('owner_dashboard.products.tags.alltags', compact('product', 'tags'));
    }

    public function createtag($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return redirect()->back()->withErrors('هذا المنتج غير موجود');
        }
         return view('owner_dashboard.products.tags.createtag', compact('product'));
    }

    public function createtag_save(Request $request)
    {
        if(!isset($request->tags))
        {
            return redirect()->back()->withErrors('يرجي ادخال التاجز ');
        }

         $this->validate($request, [
            'tags.*' => 'min:1|required|string|max:30', // unique:tags,tag',
        ]);
      
        $product = Product::find($request->product_id);

         if (isset($request->tags) && $request->tags != '') 
         {
             foreach ($request->tags as  $itemTag) 
          {

              $tagBefore = Tag::where('tag', trim($itemTag))->where('product_id', $product->id)->first();
                if ($tagBefore) 
                {
                   return redirect()->back()->withErrors('هذا التاج  '. $tagBefore->tag . ' موجود بالفعل لهذا المنتج ');
                } 
          }
          foreach ($request->tags as  $itemTag) 
          {
            Tag::create([
              'product_id' => $product->id,
              'tag'        => $itemTag,
            ]);
          }
        }       
        return redirect()->route('product.alltags', ['id' => $product->id])->withMessage('تم اضافة التاجز بنجاح');
    }

    public function edittag($id)
    {
         $tag = Tag::find($id);
        if (!$tag) {
            return redirect()->back()->withErrors('هذا  التاج غير موجود');
        }
         return view('owner_dashboard.products.tags.edittag', compact('tag'));
    }

    public function edittag_save(Request $request)
    {
        $tag = Tag::find($request->tag_id);
        if (!$tag) {
            return redirect()->back()->withErrors('هذا التاج غير موجود');
        }

         $this->validate($request, [
            'tag' => 'min:1|required|string|max:30', // unique:tags,tag,'.$tag->id,
        ]);

        $tagBefore = Tag::where('tag', trim($request->tag))->where('product_id', $tag->product_id)->first();
        if ($tagBefore) {
             return redirect()->back()->withErrors('هذا التاج  موجود بالفعل لهذا المنتج ');
        }

         $tag->update(['tag' => $request->tag]);

        return redirect()->route('product.alltags', ['id' => $tag->product->id])->withMessage('تم تحديث  التاج بنجاح');
    }

    public function deletetag($id)
    {
        $tag = Tag::find($id);
         if (!$tag) {
            return redirect()->back()->withErrors('هذا التاج غير موجود');
        }

        $tag->forceDelete();
        return redirect()->route('product.alltags', ['id' => $tag->product->id])->withMessage('تم  حذف  التاج بنجاح');  
    }

    public function getCreate()
    {

        $subcategories = Subcategory::all();
        $categories    = Category::all();
        $stores    = Store::all();
        $usertypes = Usertype::get();
        $categoriesOnline = CategoryOnline::all();
        $count = count($usertypes);
        $count_stores = count($stores);

        return view('owner_dashboard.products.create', compact('subcategories', 'categories', 'stores', 'count', 'usertypes', 'count_stores' , 'categoriesOnline'));
    }

    public function postStore(Request $request)
    {
       // $one = ($request->available_online);
    
        $this->validate($request, [
            'name'             => 'required|unique:products|max:255',
            'category_id'      => 'required|exists:categories,id',
            'subcategory_id'   => 'required|exists:subcategories,id',
            'weight'           =>  'required|numeric|min:0.1',
            // 'description'      => 'required|min:30|max:500|regex:/^[\pL0-9 ]+$/u',
            'description'          => 'required|min:30|max:1200',
            'product_benefits'     => 'min:30|max:1200',
            'seo_description'      => 'required|min:50|max:160',
            'slug'                 => 'required|max:75|unique:products,slug',
            'unique_id'        => 'required|unique:products|digits_between:1,20',
            'store_quantities.*'  => 'min:1|integer',
            'othertypes.*'       => 'required|exists:usertypes,id',
            
            'otherprices.0'      => 'required|numeric|min:0',
            'otherprices.1'      => 'required|numeric|min:1',
            'otherprices.2'      => 'required|numeric|min:1',
            'otherprices.3'      => 'required|numeric|min:1',
            'otherprices.4'      => 'required|numeric|min:1',

            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'tags.*' => 'required|string|max:30',
        ]);

        if(!$request->has('tags'))
        {
            $this->validate($request, [
                'tags.*' => 'required|string|max:30',
            ]);
        }

        if($request->store_id)
        {
            $repeated_stores = array_count_values($request->store_id);
            foreach ($request->store_id as $key => $value)
            {
                if ($repeated_stores[$value] > 1)
                {
                    return redirect()->back()->withErrors('you selected this store before change quantity better');
                }
            }
        }

        $count_usertypes = Usertype::count();
       /* if (isset($request->othertypes) && $request->othertypes != '')
        {
            $otherprices = $request->otherprices;
            $cnt = 0;

                foreach ($request->othertypes as $key => $type)
                {
                    if (empty($otherprices[$key]))
                    {
                        $cnt++;
                        if ($cnt == $count_usertypes) {
                            return redirect()->back()->withErrors('enter at least one price');
                        }
                        if (!is_numeric($otherprices[$key]) && !empty($otherprices[$key]))
                        {
                             return redirect()->back()->withErrors('price must be anumber or empty');
                        }
                    }
                }
        }*/

        /*if (isset($request->othertypes) && $request->othertypes != '')
        {
            $otherprices = $request->otherprices;
            $cnt = 0;
            $not = 0;
                foreach ($request->othertypes as $key => $type)
                {
                    if (empty($otherprices[$key]) || $otherprices[$key] == 0){
                        $cnt++;
                    } 
                    
                    if (!empty($otherprices[$key]) || $otherprices[$key] != 0){
                       $not++;
                    }
                }
                    if ($cnt == $count_usertypes) {
                              $this->validate($request, [
                         'otherprices.*'      => 'required|numeric|min:0',
                        ]);
                     }

                      if ($otherprices[0] == 0 && $otherprices[1] == 0 && $otherprices[2] == 0 && $otherprices[3] == 0 && $otherprices[4] == 0 ) {
                              $this->validate($request, [
                         'otherprices[1]'      => 'required|numeric|min:1',
                        ]);
                     }

                     if ($not > 0){
                        $this->validate($request, [
                         'otherprices.*'    => 'numeric|min:0',
                        ]);
                    }
        }*/

        if(isset($request->othertypes) && $request->othertypes != '')
        {
            $repeated_usertypes = array_count_values($request->othertypes);
            foreach ($request->othertypes as $key => $value)
            {
                if ($repeated_usertypes[$value] > 1)
                {
                    return redirect()->back()->withErrors('you selected this usertype before');
                }
            }
        }

        if($request->store_quantities)
        {
            foreach($request->store_quantities as $quantity)
            {
                if (!is_numeric($quantity))
                {
                    return redirect()->back()->withErrors('quantity must be anumber');
                }
                if ($quantity <= 0)
                {
                    return redirect()->back()->withErrors('quantity can not be less than 1');
                }
            }
        }

        $slug_with_dashes = str_replace(' ','-',$request->slug);

        $expr = Product::where('slug', $slug_with_dashes)->first();
        if ($expr) {
           $this->validate($request, [
            'slug' => 'integer',
           ]);
        }

        $arr_product = [
            'name'               => $request['name'],
            'subcategory_id'     => $request['subcategory_id'],
            'weight'             => $request->weight,
            'description'        => $request->description,
            'product_benefits'    => $request->product_benefits,
            'seo_description'    => $request->seo_description,
            'unique_id'          => $request->unique_id,
            'slug'               => $slug_with_dashes, //str_slug($request['name']),
            'category_id'        => $request['category_id'],
            'quantity'           => 0,
            'available_online'   => $request->available_online,
            'category_online_id' => $request->category_online_id ,
        ];

         if (isset($request->available_online) && $request->available_online != '') 
         {
            $otherprices = $request->otherprices;
            if ($otherprices[0] == 0 || empty($otherprices[0])) {
                 $this->validate($request, [
             //'category_online_id'      => 'required|integer|exists:category_onlines,id',
              'otherprices[0]' => 'required|numeric|min:1',
            ]);
            }
             $this->validate($request, [
             'category_online_id'      => 'required|integer|exists:category_onlines,id',
              // 'otherprices[0]' => 'required|numeric|min:1',
            ]);

              $arr_product['category_online_id']  = $request['category_online_id'];
         }

        $product = Product::create($arr_product);
        $id  = $product->id;

        if (isset($request->images) && $request->images != '') {
          foreach ($request->images as  $item) {
            Image::create([
              'product_id' => $id ,
              'image' => $item->store('uploads' , 'public') ,
            ]);
          }
        }

         if (isset($request->tags) && $request->tags != '') {
          foreach ($request->tags as  $itemTag) {
            Tag::create([
              'product_id' => $id,
              'tag' => $itemTag,
            ]);
          }
        }

        if (isset($request->othertypes) && $request->othertypes != '')
        {
            $otherprices = $request->otherprices;
                foreach ($request->othertypes as $key => $type)
                {
                    if (empty($otherprices[$key]))
                    {
                        continue;
                    }
                    else
                    {
                        Usertypeprice::create([
                            'usertype_id' => $type,
                            'product_id' => $product->id,
                            'price' => $otherprices[$key],
                        ]);
                    }
                }
        }



        if (isset($request->store_id) && $request->store_id != '')
        {
            $stores     = $request->store_id;
           $quantities = $request->store_quantities;

          foreach ($stores as $key => $loop_id)
          {
                $store = ProductStoreQuantity::where([
                    'product_id' => $product->id,
                    'store_id'   => $loop_id
                ])->first();
                if ($store)
                {
                    $store->update(['quantity' => $store->quantity + $quantities[$key]]);
                }
                else
                {
                    $product_store_quantity = ProductStoreQuantity::create([
                    'product_id' => $product->id,
                    'store_id' => $loop_id,
                    'quantity' => $quantities[$key],
                    'reason' => __('translations.add'),
                    'type' => '+',
                    'status' => 'a',
                   ]);
                }
          }
      }

        return redirect('/owner/manage/products/view/' . $product->id);

    }

    public function manage_price($id)
    {
        $product = Product::find($id);
        if (!$product)
        {
           return redirect()->back()->withErrors('product not found');
        }
        $usertypes = Usertype::get();
        $count_usertypes = count($usertypes);
        $prices = Usertypeprice::where('product_id' , $product->id)->get();
        return view('owner_dashboard.products.manage_price', compact('product', 'usertypes', 'count_usertypes', 'prices'));
    }

    public function manage_products_refunds(Request $request)
    {
        if (!$request->has('from') && !$request->has('to'))
      {
       // $from = Carbon::today()->subMonth()->toDateString();
       $from = Carbon::today()->subDays(1)->toDateString();
        $to   = Carbon::today()->toDateString();

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';
      }
      else
      {
        $this->validate($request, [
          'from' => 'required|date|before_or_equal:to',
          'to'   => 'required|date|after_or_equal:from',
        ]);

        $from = $request->from;
        $to   = $request->to;

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';
      }

       $pos_sales  = History::where('order_status' , '!=', 'in progress')
                            ->where('order_status' , '!=', 'pending')
                            ->where('order_status' , '!=', 'delivered')
                            ->where('order_status' , '!=', 'canceled')
                            ->where('price', '>', 0)
                            ->where('quantity', '>', 0)
                            ->pluck('bill_id');

       $refunds = History::whereIn('bill_id', $pos_sales)
                            ->where('quantity', '<', 0)
                            ->where('created_at', '>=', $date_from)
                            ->where('created_at', '<=', $date_to)
                            ->orderBy('created_at', 'DESC')
                            ->paginate(10);
                            
        return view('owner_dashboard.products.refunds', compact('refunds', 'from', 'to'));
    }

    public function manage_products_onlinerefunds()
    {
        $onlines  = History::where('order_status', 'delivered')->pluck('bill_id');
       // return $onlines;
         $refunds = History::whereIn('bill_id', $onlines)->where('quantity', '<', 0)->paginate(10);
        // return $refunds;
        return view('owner_dashboard.products.onlinerefunds', compact('refunds'));
    }

    public function post_manage_price(Request $request)
    {
         $product = Product::find($request->id);

        $this->validate($request, [
            'othertypes.*' => 'required:array',
            'otherprices.0'      => 'required|numeric|min:0',
            'otherprices.1'      => 'required|numeric|min:1',
            'otherprices.2'      => 'required|numeric|min:1',
            'otherprices.3'      => 'required|numeric|min:1',
            'otherprices.4'      => 'required|numeric|min:1',
        ]);

        // $product = Product::find($request->id);
        $count_usertypes = Usertype::count();
        $product_prices  = Usertypeprice::where('product_id', $product->id)->get();
        $ids = array();
        foreach ($product_prices as $item) {
            array_push($ids, $item->id);
        }

       if($request->othertypes)
        {
            $repeated_usertypes = array_count_values($request->othertypes);
            foreach ($request->othertypes as $key => $value)
            {
                if ($repeated_usertypes[$value] > 1)
                {
                    return redirect()->back()->withErrors('you selected this usertype before');
                }
            }
        }
         
        if (isset($request->othertypes) && $request->othertypes != '')
        {
            $otherprices = $request->otherprices;
                foreach ($request->othertypes as $key => $type)
                {
                    if (empty($otherprices[$key]))
                    {
                        // continue;
                         $one =  Usertypeprice::where('product_id', $product->id)
                                     ->where('usertype_id', $type)->first();
                                     if ($one){
                                        $one->update([
                                            'usertype_id' => $type,
                                            'product_id'  => $product->id,
                                            'price'       => 0, //$otherprices[$key],
                                        ]);

                                     }else{
                                        Usertypeprice::create([
                                            'usertype_id' => $type,
                                            'product_id' => $product->id,
                                            'price' => 0, // $otherprices[$key],
                                        ]);

                                    }
                    }
                    else
                    {

                       $one =  Usertypeprice::where('product_id', $product->id)
                                     ->where('usertype_id', $type)->first();
                                     if ($one){
                                        $one->update([
                                            'usertype_id' => $type,
                                            'product_id'  => $product->id,
                                            'price'       => $otherprices[$key],
                                        ]);

                                     }else{
                                        Usertypeprice::create([
                                            'usertype_id' => $type,
                                            'product_id' => $product->id,
                                            'price' => $otherprices[$key],
                                        ]);

                                    }
                        //return $one;
                    }
                }
        return redirect()->back()->withMessage(__('translations.product_updated_successfuly'));
      /*
        $this->validate($request, [
            'othertypes.*' => 'required:array',
            'otherprices.*' => 'required:array',
        ]);

        $product = Product::find($request->id);
        $count_usertypes = Usertype::count();
        $product_prices  = Usertypeprice::where('product_id', $product->id)->get();
        $ids = array();
        foreach ($product_prices as $item) {
            array_push($ids, $item->id);
        }

       if($request->othertypes)
        {
            $repeated_usertypes = array_count_values($request->othertypes);
            foreach ($request->othertypes as $key => $value)
            {
                if ($repeated_usertypes[$value] > 1)
                {
                    return redirect()->back()->withErrors('you selected this usertype before');
                }
            }
        }

        if (isset($request->othertypes) && $request->othertypes != '')
        {
            $otherprices = $request->otherprices;
            $cnt = 0;

                foreach ($request->othertypes as $key => $type)
                {
                    if (empty($otherprices[$key]))
                    {
                        $cnt++;
                        if ($cnt == $count_usertypes) {
                            return redirect()->back()->withErrors('enter at least one price');
                        }
                    }
                    if (!is_numeric($otherprices[$key]) && !empty($otherprices[$key]))
                        {
                            Session::put('error', __('translations.price_must_be_anumber'));
                           return redirect()->back();
                        }
                }
        }

        if (isset($request->othertypes) && $request->othertypes != '')
        {
            $otherprices = $request->otherprices;
                foreach ($request->othertypes as $key => $type)
                {
                    if (empty($otherprices[$key]))
                    {
                        continue;
                    }
                    else
                    {

                       $one =  Usertypeprice::where('product_id', $product->id)
                                     ->where('usertype_id', $type)->first();
                                     if ($one){
                                        $one->update([
                                            'usertype_id' => $type,
                                            'product_id'  => $product->id,
                                            'price'       => $otherprices[$key],
                                        ]);

                                     }else{
                                        Usertypeprice::create([
                                            'usertype_id' => $type,
                                            'product_id' => $product->id,
                                            'price' => $otherprices[$key],
                                        ]);

                                    }
                        //return $one;
                    }
                }
        return redirect()->back()->withMessage(__('translations.product_updated_successfuly'));*/
        }
    }

    public function view_product_prices()
    {
        $products  = Product::get();

        // $prices = Usertypeprice::where('product_id', $product->id)->get();

         return view('owner_dashboard.products.product_prices', compact('products'));
    }

    public function view_product_history(Request $request, $id)
    {
        $product  = Product::find($id);
        if (!$product)
         {
            return redirect()->route('manage.products.all')->withErrors(__('translations.product_not_found'));
         }

         if (!isset($request->from) && !isset($request->to))
          {
           // $from = Carbon::today()->subMonth()->toDateString();
            $from = Carbon::today()->subDays(1)->toDateString();
            $to   = Carbon::today()->toDateString();

            $date_from = $from.' 00:00:00';
            $date_to   = $to.' 23:59:59';
          }
          else
          {
            $this->validate($request, [
              'from' => 'required|date|before_or_equal:to',
              'to'   => 'required|date|after_or_equal:from',
            ]);

            $from = $request->from;
            $to   = $request->to;

            $date_from = $from.' 00:00:00';
            $date_to   = $to.' 23:59:59';
          }

         $orders = History::where('product_id', $product->id)
                                      ->where('order_status' , '!=', 'in progress')
                                      ->where('order_status' , '!=', 'pending')
                                      ->where('order_status' , '!=', 'canceled')
                                      ->where('created_at', '>=', $date_from)
                                      ->where('created_at', '<=', $date_to)
                                      ->orderBy('created_at', 'DESC')
                                      ->paginate(10);
                                      // dd($orders);

        $count_checkout = History::where('product_id', $product->id)
                                        ->where('order_status' , '!=', 'in progress')
                                        ->where('order_status' , '!=', 'pending')
                                        ->where('order_status' , '!=', 'canceled')
                                        ->where('created_at', '>=', $date_from)
                                        ->where('created_at', '<=', $date_to)
                                        ->sum('price');

        $count_orders_purchased  = History::where('product_id', $product->id)->where('order_status' , '!=', 'in progress')->where('order_status' , '!=', 'canceled')
                                          ->where('order_status' , '!=', 'pending')
                                          ->where('price', '>', 0)
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                         // ->groupBy('bill_id')
                                          ->count();

        $count_orders_refunded   = History::where('product_id', $product->id)->where('order_status' , '!=', 'in progress')->where('order_status' , '!=', 'canceled')
                                          ->where('order_status' , '!=', 'pending')
                                          ->where('price', '<', 0)
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->count();

        $count_products = History::where('product_id', $product->id)->where('order_status' , '!=', 'in progress')
                                     ->where('order_status' , '!=', 'pending')
                                     ->where('order_status' , '!=', 'canceled')
                                     ->where('created_at', '>=', $date_from)
                                     ->where('created_at', '<=', $date_to)
                                     ->sum('quantity');

        return view('owner_dashboard.products.history', compact('product', 'orders', 'from', 'to', 'count_products', 'count_orders_purchased', 'count_orders_refunded', 'count_checkout'));
    }

    public function getEditProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            //$price_without_currency = filter_var($product->price, FILTER_SANITIZE_NUMBER_INT);

            $subcategories = Subcategory::all()->pluck('name', 'id');
            $categories    = Category::all()->pluck('name', 'id');
            $categoriesOnline    = CategoryOnline::all();
            $stores        = Store::get();
            $images = Image::where('product_id' , $id)->get();
            $tags = Tag::where('product_id' , $id)->get();

            return view('owner_dashboard.products.edit', compact('subcategories', 'categories', 'product', 'price_without_currency', 'stores' , 'images' , 'categoriesOnline', 'tags'));
        }
        abort(404);
    }
/*
    public function getAttributesProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
          $subcategory = $product->subcategory;
          // return $subcategory;
          if ($subcategory) {
              $attributes = $subcategory->attribute;
              // return $attributes;
              $attributes_arrays = [];
              foreach ($attributes as $value) {
                $attribute_type_name = $value->attributeType->type;
                $attributes_arrays[$attribute_type_name][] = ['id' => $value->id, 'name' => $value->name];
              }
              // return $attributes_arrays;
              $selected_attributes = $product->attributeProducts->pluck('attribute_id')->toArray();
              // return $attributes_arrays;
              return view('owner_dashboard.products.editAttributes', compact('attributes_arrays', 'selected_attributes', 'product'));
          }
          abort(404);
        }
        abort(404);
    }

    public function postAttributesProduct(Request $request, $id)
    {
        $this->validate($request, [
            'attributes' => 'required|array'
        ]);
        $request_data = $request->all();
        $product = Product::find($id);
        if (!$product) {
            abort(404);
        }
        // $attributeProducts = $product->attributeProducts;
        if($product->attributeProducts->count() > 0){
          $product->attributeProducts()->delete();
        }
        // $attributeProducts->delete();
        $attributes = $request_data['attributes'];

        foreach ($attributes as $key => $value) {
          // echo $value;
          AttributeProduct::create(['attribute_id' => $value,'product_id' => $product->id]);
        }
        // return '';
        return redirect()->back()->withMessage(__('translations.attributes_updated_successfully'));

    }
*/
    public function postEditProduct(Request $request, $id)
    {
        // return $request->images;
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('manage.products.all')->withErrors(__('translations.product_not_found'));
        }

        $this->validate($request, [
            'name' => 'required|max:255|unique:products,name,'.$product->id,
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'unique_id' => 'required|digits_between:1,20|unique:products,unique_id,'.$product->id,
            'weight'       => 'required|numeric',
            // 'description'      => 'required|min:30|max:500|regex:/^[\pL0-9 ]+$/u',
            'description'      => 'required|min:30|max:1200',

            'product_benefits'     => 'min:30|max:1200',
            'slug' => 'required|max:75|unique:products,slug,'.$product->id,
            'seo_description'      => 'required|min:50|max:160',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'images2.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg', 

           // 'tags.*' => 'required|string|max:30',
            'tags2.*' => 'required|string|max:30',
        ]);

        if (isset($request->tags2) && $request->tags2 != '') 
        {
           $this->validate($request, [
            'tags2.*' => 'required|string|max:30',
           ]);
        }

        $slug_with_dashes = str_replace(' ','-',$request->slug);
        $expr = Product::where('id', '!=', $id)->where('slug', $slug_with_dashes)->first();
        if ($expr) {
           $this->validate($request, [
            'slug' => 'integer',
           ]);
        }

        $arr_product = [
            'name'           => $request['name'],
            'unique_id'      => $request->unique_id,
            'weight'         => $request->weight,
            'description'    => $request->description,
            'product_benefits'    => $request->product_benefits,
            'seo_description'    => $request->seo_description,
            'subcategory_id' => $request['subcategory_id'],
            'category_id'    => $request['category_id'],
            'slug' => $slug_with_dashes,
            'available_online'   => $request->available_online,
            'category_online_id'   => $request->category_online_id,
        ];

        if (isset($request->images) && $request->images != '') {
          foreach ($request->images as $key => $item) {
            foreach ($request->selections as $selection) {
              $productImage =  Image::where('id' , $selection)->first();
              $productImage->update([
                'image' => $item->store('uploads' , 'public'),
              ]);
            }
          }
        }
        if (isset($request->images2) && $request->images2 != '') {
          foreach ($request->images2 as $key => $image) {
            Image::create([
              'product_id' => $id ,
              'image' => $image->store('uploads' , 'public') ,
            ]);
          }
        }

        if(isset($request->activations) && $request->activations != ''){
            foreach ($request->activations as $activation) {
              $this_image = Image::where('id', $activation)->first();
              $this_image->delete();
           }
        }

        if (isset($request->tags) && $request->tags != '') {
          foreach ($request->tags as $key => $tagitem) {
            foreach ($request->tagselections as $tagselection) {
              $productTag =  Tag::where('id' , $tagselection)->first();
              $productTag->update([
                'tag' => $tagitem,
              ]);
            }
          }
        }
        if (isset($request->tags2) && $request->tags2 != '') {
          foreach ($request->tags2 as $key => $tagval) {
            Tag::create([
              'product_id' => $id ,
              'tag' => $tagval,
            ]);
          }
        }

        if(isset($request->tagactivations) && $request->tagactivations != ''){
            foreach ($request->tagactivations as $tagactivation) {
              $this_tag = Tag::where('id', $tagactivation)->first();
              $this_tag->forceDelete();
           }
        }

        $old_name            = $product->name;
        $old_unique_id       = $product->unique_id;
        $old_weight          = $product->weight;
        $old_category_id     = $product->category_id;
        $old_subcategory_id  = $product->subcategory_id;

        $new_name           = $request->name;
        $new_unique_id      = $request->unique_id;
        $new_weight         = $request->weight;
        $new_category_id    = $request->category_id;
        $new_subcategory_id = $request->subcategory_id;

       /* if ($old_name == $new_name && $old_unique_id == $new_unique_id && $old_weight == $new_weight && $old_category_id == $new_category_id && $old_subcategory_id == $new_subcategory_id) {
            return redirect()->route('manage.products.all')->withMessage(__('translations.data_no_changed'));
         }
         else
         {*/
           $product->update($arr_product);
           return redirect()->route('manage.products.all')->withMessage(__('translations.product_updated_successfuly'));
        // }
        //abort(404);
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->wish()->delete();
            $product->history()->delete();
            $product->order()->delete();
            $product->delete();
            return back();
        }
        abort(404);
    }

    public function getQuantityView($id)
    {
        $product = Product::find($id);
        $product_quantity = ProductStoreQuantity::where('product_id', $product->id)->sum('quantity');

        if ($product) {
            $stores = Store::select('id', 'name')->get();
            return view('owner_dashboard.products.Quantity', compact('product', 'stores', 'product_quantity'));
        }
        abort(404);
    }

     public function getQuantityView_post(Request $request)
    {
         if ( ($request->has('addCheck') && $request->addCheck !== null) && ($request->has('subCheck') && $request->subCheck !== null) ) {
            $this->validate($request, [
            'addCheck' => 'integer',
         ]);
        }
        if ( (!$request->has('addCheck') || $request->addCheck === null) && (!$request->has('subCheck') || $request->subCheck === null) ) {
            $this->validate($request, [
            'addCheck' => 'required',
         ]);
        }
        if ($request->has('subCheck') && $request->subCheck !== null) {
            $this->validate($request, [
            'quantity' => 'required|integer|min:1|max:999999',
            'shiporder_id' => 'required|integer|unique:product_store_quantities,shiporder_id|min:2|digits_between:1,9',
            'store_id' => 'required|exists:stores,id',
            'reason' => 'required|min:3|max:250',
         ]);
        }
       if ($request->has('addCheck') && $request->addCheck !== null){
            $this->validate($request, [
            'quantity' => 'required|integer|min:1|max:999999',
            'shiporder_id' => 'required|integer|unique:product_store_quantities,shiporder_id|min:2|digits_between:1,9',
            'store_id' => 'required|exists:stores,id',
            // 'reason' => 'required|min:3|max:250',
         ]);
        }

        if ($request->has('subCheck') && $request->subCheck != '')
        {
            $product = Product::find($request->id);
            $store = ProductStoreQuantity::where('store_id', $request->store_id)
                                             ->where('product_id', $product->id)
                                             ->first();
                if(!$store){
                  return redirect()->back()->withErrors(__('translations.product_isnt_available_in_this_store'));
                }

      $product_states  = ProductStoreQuantity::where([
                                            'product_id' => $product->id,
                                            'store_id' => $request->store_id
                                        ])->get();
              $available_quantity = 0;
              if(!$product_states->isEmpty())
              {
                foreach ($product_states as $key => $value)
                {
                  $available_quantity += (int)$value->quantity;
                }
              }

                if ($available_quantity >= $request->quantity) 
                {
                  // return $product->availableCodes($request->store_id);
                  $product_store_quantity = ProductStoreQuantity::create([
                      'product_id' => $product->id,
                      'store_id' => $request->store_id,
                      'quantity' => -$request->quantity,
                      'reason' => $request->reason,
                      'shiporder_id' => $request->shiporder_id,
                      'type' => '-',
                      'status' => 'r',
                  ]);
                  return redirect()->back()->withMessage(__('translations.quantity_edited'));
              }
              else{
                  return redirect()->back()->withErrors(__('translations.quantity_not_available_to_subtract'));
                }
        }
        else
        {
            $product = Product::find($request->id);
            if ($product) 
            {
                $product_store_quantity = ProductStoreQuantity::create([
                    'product_id' => $product->id,
                    'store_id' => $request->store_id,
                    'quantity' => $request->quantity,
                    'reason' => __('translations.add'),
                    'shiporder_id' => $request->shiporder_id,
                    'type' => '+',
                    'status' => 'a',
                ]);
           }
            return redirect()->back()->withMessage(__('translations.added'));
        }
    }

    public function getAddQuantityProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            return view('owner_dashboard.products.addQuantity', compact('product'));
        }
        abort(404);
    }

    public function postAddQuantityProduct(Request $request, $id)
    {
        $this->validate($request, [
            'quantity' => 'required|integer|min:1',
            'shiporder_id' => 'required|integer|digits_between:1,11',
        ]);

        $shiporder_id = $request->shiporder_id;
        $found = ProductStoreQuantity::where('shiporder_id', $shiporder_id)->first();
        if ($found) {
            return response()->json([
                'message' => __('translations.shiporder_taken'),
                'code' => 400
            ]);
        }

        $product = Product::find($id);
        if ($product) {

            $product_store_quantity = ProductStoreQuantity::create([
                'product_id' => $product->id,
                'store_id' => $request->store_id,
                'quantity' => $request->quantity,
                'reason' => __('translations.add'),
                'shiporder_id' => $request->shiporder_id,
                'type' => '+',
                'status' => 'a',
            ]);
            return response()->json([
                'message' => __('translations.shiporder_taken'),
                'code' => 200
            ]);
//            $product->create_barcodes_for_product($product_store_quantity->quantity, $product_store_quantity->store_id, $product_store_quantity->id);
            // return response()->json(__('translations.added'), 200);
        }
        abort(404);
    }

    public function getDeleteQuantityProduct($id)
    {
        // $product = Product::find($id);
        // return $product->availableCodes();
        // $quantity = $request->quantity;
        // $store_id = $request->store_id;
        // if ($product) {
        //     return view('owner_dashboard.products.deleteQuantity', compact('product','quantity','store_id'));
        // }
        // abort(404);
    }

    public function postDeleteQuantityProduct(Request $request, $id)
    {
      // return response()->json('test',200);
        $this->validate($request, [
            'quantity' => 'required|numeric|min:1',
            'shiporder_id' => 'required',
            'reason' => 'required|min:3|max:50',
        ]);

        $shiporder_id = $request->shiporder_id;
        $found = ProductStoreQuantity::where('shiporder_id', $shiporder_id)->first();
        if ($found) {
            return response()->json([
                'message' => __('translations.shiporder_taken'),
                'code' => 400
            ]);
        }
                $product = Product::find($id);
                if(!$product){
                  return response()->json(__('translations.cant_edit_quantity_for_this_product'));
                }
                $store = ProductStoreQuantity::where('store_id', $request->store_id)
                                             ->where('product_id', $product->id)
                                             ->first();
                if(!$store){
                  return response()->json([
                    'message' => __('translations.product_isnt_available_in_this_store'),
                    'code' => 408
                ]);
                }



      $product_states  = ProductStoreQuantity::where([
                                            'product_id' => $product->id,
                                            'store_id' => $request->store_id
                                        ])->get();
      $available_quantity = 0;
      if(!$product_states->isEmpty())
      {
        foreach ($product_states as $key => $value)
        {
          $available_quantity += (int)$value->quantity;
        }
      }

                if ($available_quantity >= $request->quantity) {
                  // return $product->availableCodes($request->store_id);
                  $product_store_quantity = ProductStoreQuantity::create([
                      'product_id' => $product->id,
                      'store_id' => $request->store_id,
                      'quantity' => -$request->quantity,
                      'reason' => $request->reason,
                      'shiporder_id' => $request->shiporder_id,
                      'type' => '-',
                      'status' => 'r',
                  ]);

                  return response()->json([
                'message' => 'done',
                'code' => 200
            ]);

                }
                else{
                  return response()->json(__('translations.quantity_not_available_to_subtract'), 409);
                  // return response()->json(__('translations.check_your_quantity'), 409);
                }
                return response()->json(__('translations.quantity_edited'), 200);

        abort(404);
    }

    public function getEditDiscount($id)
    {
        $product = Product::find($id);
        if(!$product)
        {
            return redirect()->back()->withErrors(__('translations.product_mot_found'));
        }

        $precentege = 0;
        if ($product->discount != 0) {
            // $price = explode(' ', $product->price);
            // $discount = explode(' ', $product->discount);
            // $price_for_discount = ($price[0] - $discount[0]) / $price[0];
            // $precentege = $product->discount;
        }
       /* if ($product->local_price != null) {
            $country = Country::where('short_name', $product->country_code)->first();
            $currency_configuration = Configuration::where('name', 'main_currency')->first();
            if ($country) {
                $product['currency']  = $country->currency->name;
            } else {
                $product['currency'] = $currency_configuration->value;
            }
            // $product->country_code == 'EG' ? $product['currency'] = 'EGP' : $product['currency'] = 'SR';
        }*/
        return view('owner_dashboard.products.editDiscount', compact('product'));
    }

    public function postEditDiscount($id, Request $request)
    {
        $product = Product::find($id);
        if(!$product)
        {
            return redirect()->back()->withErrors(__('translations.product_mot_found'));
        }
        // return $precentege;
        if ($request->fire_discount) {
            $price = explode(' ', $product->pricing($product->id));
             $this->validate($request, [
                    'discount' => 'required|numeric|min:1|max:' . $price[0],
                ]);
            if (isset($request->discount) && $request->discount != '')
            {
                if (!is_numeric($request->discount))
                {
                  return redirect()->back()->withErrors(__('translations.discount_must_be_number'));
                }
              $price = explode(' ', $product->pricing($product->id));
              $discount = explode(' ', $request->discount);
              $price_for_discount = ($price[0] - $discount[0]) / $price[0];

              $precentege = $price_for_discount * 100;

                $this->validate($request, [
                    'discount' => 'required|numeric|min:1|max:' . $price[0],
                ]);

                $product->update([
                    'discount' => $precentege,
                ]);
            }
            /*if (isset($request->local_discount) && $request->local_discount != '') {
                $price = explode(' ', $product->local_price);
                $price = $price[0] - 1;
                $this->validate($request, [
                    'local_discount' => 'required|integer|min:1|max:' . $price,
                ]);
                $product->update([
                    'local_discount' => $request->local_discount,
                ]);
            }*/
            return redirect()->back()->withMessage(__('translations.product_discount_updated_successfully'));
        } else {
            $product->update([
                'discount' => null,
            ]);
            return redirect()->back()->withErrors(__('translations.product_discount_removed_successfully'));
        }
    }
/*
    public function getAds()
    {
        $ad = Ad::orderBy('created_at', 'desc')->first();
        $products = Product::all();
        return view('owner_dashboard.ads.adsEdit', compact('ad', 'products'));
    }

    public function postAds(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'product_id' => 'required|exists:products,id',
        ]);
        $old_ad = Ad::orderBy('created_at', 'desc')->first();
        $new_ad = new Ad;
        $new_ad->product_id = $request->product_id;
        if ($request->file('image')) {
            $file = $request->file('image');
            $image = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = public_path() . '/shop_images/slider/';
            if (!$file->move($path, $image)) {
                abort(500);
            }
            /*if ($old_ad) {
            unlink($path . $old_ad->image);
            }*/
       //     $new_ad->image = $image;
      //  }
      //  if (!$new_ad->save() && $old_ad->delete()) {
        //    abort(500);
       // }
      //  return back()->withMessage(__('translations.ad_has_been_created'));

   // }

  /*  public function getProductCodes($id)
    {
      $ids = Barcode::where([
        'product_id' => $id,
        'state' => '1',
        ])->get(['created_at']);
      $exception = Barcode::where([
        'product_id' => $id,
        'state' => '1',
      ])
      ->get(['code']);
      // return $exception;
      $codes = Barcode::where([
        'product_id' => $id,
        'state' => '0',
        // ['created_at','>',$ids],
      ])
      // ->whereNotIn('code',$exception)
      // ->toSql();
      ->get();
      // return $codes;
      return view('owner_dashboard.products.codes',compact('codes'));
    }
*/

  /*========================================
      generate products in excel sheet
  ==========================================*/
  public function excel()
  {
    return Excel::download(new ProductsExport(), 'products.xlsx');
  }

  /*========================================
    generate product prices in excel sheet
  ==========================================*/
  public function prices_excel()
  {
    return Excel::download(new ProductPricesExport(), 'product_prices.xlsx');
  }

  /*========================================
    generate refunds products in excel sheet
  ==========================================*/
  public function refunds_excel()
  {
    return Excel::download(new RefundsExport(), 'refunds.xlsx');
  }

   public function allRefunds_excel(Request $request)
    {
       set_time_limit(0);
      ini_set("memory_limit",-1);

        $from = $request->from.' 00:00:00';
        $to   = $request->to. ' 23:59:59';
      return Excel::download(new allRefundsExport($from, $to), 'allRefundsExport.xlsx');
    }
}
