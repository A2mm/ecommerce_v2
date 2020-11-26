@extends('shop.master')

@section('body')

  <div class="content_box">
  <div class="container">
    <div class="row">

      <div class="col-md-9">

       <div class="singel_right">
         <div class="labout span_1_of_a1">
         <div id="getting-started"></div>

         <div class="flexslider">
         <ul class="slides">
        @foreach ($product->all_images_paths() as $path)
          <li>
            <img src="{{asset($path)}}" class="img-fluid"/>
          </li>
        @endforeach
         </ul>
        </div>
      </div>

      @if(Auth::user() && Auth::user()->role('user'))
      <div class="cont1 span_2_of_a1 simpleCart_shelfItem">
      <h1>{{(App::isLocale('ar')) ? $product->arabic_name : $product->name}}</h1>

        <div class="price_single">
        <span class="amount item_price actual">
          @if (App::isLocale('ar'))
        Start Price: {{$auction->start_price}}$ <!--{{$product->currency->arabic_name or ''}}-->
        @else
        Start Price: {{$auction->start_price}}$ <!--{{$product->currency->name or ''}} -->
        @endif
        </br>
        @if($auction->best_price)
        Best Price:<span class="best_pr">{{$auction->best_price}}$</span>
         @if($best_user_name) by {{$best_user_name}} @endif
         <br>
        @endif
        <br>
        {!! Form::open(['route' => 'shop.auction.store', 'files' => true]) !!}
        <div class="form-group">
         <label for="price">Enter Your Price</label>
         <input class="form-control" id="price" type="number" name="price">
         <input type="hidden" name="auction_id" value="{{$auction->id}}">
         <input type="hidden" name="g" value="{{request()->g}}">
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">{{trans('layout.Submit')}}</button>
        </div>
        {!! Form::close() !!}
        </span>
      </div>
@if(!empty($product->description))
<h2 class="quick">{{trans('layout.Overview')}}:</h2>
<p class="quick_desc">
@if (App::isLocale('ar'))
        @if ($product->arabic_description)
            {{$product->arabic_description}}
            @else
            {{$product->description}}
            @endif
        @else
          {{$product->description}}
        @endif

<!--{{(App::isLocale('ar')) ? $product->arabic_description : $product->description}}-->
</p>
@else
<h2 class="quick">{{trans('layout.Overview')}}:</h2>
<p class="quick_desc">{{trans('layout.No_description')}}.</p>
@endif

      <input type="hidden" name="g" value="{{request()->g}}">
      <input type="hidden" name="Subcategory" value="{{request()->Subcategory}}">
      <input type="hidden" name="accessory" value="{{request()->accessory}}">
      <input type="hidden" name="c" value="{{request()->c}}">
      <input type="hidden" name="product_id" value="{{$product->id}}">


      {{--
      {!! Form::open(['route' => 'new.order.user']) !!}


      <ul class="product-qty">
         <span>{{trans('layout.Quantity')}}:</span>



         {{ Form::selectRange('quantity', 0, $product->quantity, 1) }}

         </select>
        </ul>
        @if($product->quantity>0)
        <div class="btn_form button item_add item_1">
          <input type="submit" value="Add to Cart" title="" id="one_c" >
          {!! Form::close() !!}
        </div>
        @endif
        --}}

      </div>
    @elseif (Auth::user() && Auth::user()->role('affiliate'))
      @if(Auth::user()->slug == NULL)
        <p>
          You need to setup your slug to be able to generate links
          <a href="{{route('affiliate.manage.profile')}}">Go to your settings</a>
        </p>
      @else
      <div class="cont1 span_2_of_a1 simpleCart_shelfItem">
        <h3>Make a link for this product?</h3>
        {!! Form::open(['route' => 'affiliate.manage.link.generate']) !!}
        <input type="hidden" name="product_id" value="{{$product->id}}">
          <input type="text" name="username" value="{{Auth::user()->slug}}" disabled>
          /
          <input type="text" name="slug" value="">
          <div class="btn_form button item_add item_1">
          <input type="submit" value="Generate" title="">
          {{--{!! Form::close() !!}--}}
          </div>
      </div>
      @endif


     @else
      <div class="cont1 span_2_of_a1 simpleCart_shelfItem">
      <h1>{{(App::isLocale('ar')) ? $product->arabic_name : $product->name}}</h1>

        <div class="price_single">
       <span class="amount item_price actual">
        @if (App::isLocale('ar'))
        Start Price: {{$auction->start_price}}$ <!--{{$product->currency->arabic_name or ''}}-->
        @else
        Start Price: {{$auction->start_price}}$ <!--{{$product->currency->name or ''}}-->
        @endif
        </br>
        @if($auction->best_price)
        Best Price:<span class="best_pr">{{$auction->best_price}}</span>
        <br>
        @endif
        <br>
        </span>
      </div>
@if(!empty($product->description))
<h2 class="quick">{{trans('layout.Overview')}}:</h2>
<p class="quick_desc">
@if (App::isLocale('ar'))
        @if ($product->arabic_description)
            {{$product->arabic_description}}
            @else
            {{$product->description}}
            @endif
        @else
          {{$product->description}}
        @endif

<!--{{(App::isLocale('ar')) ? $product->arabic_description : $product->description}}-->
</p>
@else
<h2 class="quick">{{trans('layout.Overview')}}:</h2>
<p class="quick_desc">{{trans('layout.No_description')}}.</p>
@endif


@if (!Auth::check())
{{--<a class="woman" href="{{url('login')}}">{{trans('layout.You_need_to_login')}}</a>--}}
<a class="woman" href="{{url('login?redirectTo='.Request::url())}}">{{trans('layout.You_need_to_login')}}</a>
      </div>
@endif

    @endif

      <div class="clearfix"></div>
      </div>
      <script type="text/javascript">
      $(window).load(function() {
      $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails"
      });
      });

      </script>


    </div>
    <div class="col-md-3">
      <div class="update">
        <span style="color:#85a56c">Starting Price is {{$auction->start_price}}$ ,
          All the price updates Will be here , Get Ready !</span>
      @foreach($results as $result)

      <span>{{($result->user->name)}} <big>{{$result->price}}$</big></span><br>

      @endforeach

      </div>
    </div>
  </div>

  </div>
</div>
    <script type="text/javascript">
  $("#getting-started")
  .countdown("{{$auction->expiry_time}}", function(event) {
    $(this).text('Expiry Date: ' +
      event.strftime('%D days %H:%M:%S')
    );
  });
</script>

  <script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('9d87d2397a79da6c6ff1', {
      cluster: 'eu',
      encrypted: true
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      var current_price = parseInt($('.best_pr').text().trim(), 10);

      if(parseInt(data.message) > current_price){
        $('.best_pr').html(data.message);
        var toAppend = data.user_name+' '+data.message+'<br>';
        $('.update').prepend(toAppend);
      }
    });
  </script>


@stop
