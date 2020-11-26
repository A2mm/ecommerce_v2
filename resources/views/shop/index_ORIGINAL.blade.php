@extends('shop.master')
@section('body')
<div class="content_box">
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="menu_box">
            <h3 class="menu_head">Categories
<button class="hamburger hamburger--collapse hidden-md hidden-lg" type="button">
  <span class="hamburger-box">
    <span class="hamburger-inner"></span>
  </span>
</button>
</h3>
            <ul class="nav">
              @forelse ($categories as $category)
                <li><a href="{{$category->path()}}">{{$category->name}}</a></li>
              @empty
                <li>No Categories</li>
              @endforelse
           </ul>
      </div>
    </div>
    <div class="col-md-9">
      <h3 class="m_1">New Products</h3>
       <div class="content_grid">
         @forelse($new_products as $item)
          @if (($loop->index) % 3 == 0)
             <div class="content_grid">
          @endif
         <div class="col_1_of_3 span_1_of_3 simpleCart_shelfItem">
             <a href="{{$item->path()}}">
             <div class="inner_content clearfix">
            <div class="product_image">
              <img src="{{asset($item->image_path())}}" class="img-responsive" alt=""/>
              {{-- <a href="" class="button item_add item_1"> </a> --}}
               <div class="product_container">
                 <div class="cart-left">
                 <p class="title">{{$item->name}}</p>
                 </div>

                 <span class="amount item_price">{{($item->price == 0) ? 'No price' : '$'. ($item->price)}}</span>
                 <div class="clearfix"></div>
                 </div>

                 <div class="colors" style="
                      position: absolute;
                      top: 10px;
                  ">
                   @foreach ($item->colors as $color)
                    <div class="color" style="
                          background-color: {{$color->code}};
                          width: 15px;
                          height: 15px;
                          margin-bottom: 5px;
                          border: 1px solid white;
                      "></div>
                     @endforeach
                  </div>

                  
              </div>
                      </div>
                   </a>
          </div>
          @if (($loop->index+1) % 3 == 0)
            </div>
            <div class="clearfix"></div>
          @endif
        @empty
          <p>No Products</p>
        @endforelse
      </div>
    </div>
  </div>
</div>
</div>
@stop
