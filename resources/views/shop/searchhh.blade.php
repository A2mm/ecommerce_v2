@extends('shop.master')
@section('body')

<div class="content_box">
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="menu_box">
            <h3 class="menu_head">{{trans('layout.Search')}}:
            <button class="hamburger hamburger--collapse hidden-md hidden-lg" type="button">
              <span class="hamburger-box">
                <span class="hamburger-inner"></span>
              </span>
            </button>
</h3>

<div id="search_filter" class="nav" style="
    background-color: #0ca26b;
    padding: 10px;
    color: white;
">
  <h3>
    {{trans('layout.Category')}}
  </h3>
  <label class="checkbox-inline"><input type="radio" name="category" value=".g_1">{{trans('layout.Male')}}</label> <br>
  <label class="checkbox-inline"><input type="radio" name="category" value=".g_0">{{trans('layout.Female')}}</label> <br>
  <label class="checkbox-inline"><input type="radio" name="category" value=".g_2">{{trans('layout.Unisex')}}</label>  <br>
  <label class="checkbox-inline"><input type="radio" name="category" value=".g_1,.g_2,.g_0">{{trans('layout.All')}}</label>

  <hr>
  <h3>
    {{trans('layout.Color')}}
  </h3>

  @foreach (App\Color::all() as $color)
    <input type="radio" value=".c_{{$color->id}}" name="colors" id="{{$color->name}}" class="colorPlatte"/>
      <label for="{{$color->name}}" style="background-color: {{$color->code}};" ></label>
  @endforeach
  <hr>

  <h3>
    {{trans('layout.Category')}}
  </h3>
  @foreach (App\Subcategory::all() as $sub)
  <label class="checkbox-inline"><input name="category" type="radio" value=".s_{{$sub->id}}">{{(App::isLocale('ar')) ? $sub->arabic_name : $sub->name}}</label> <br>
  @endforeach


</div>



      </div>
    </div>
    <div class="col-md-9">
      <h3 class="m_1">{{trans('layout.Search_Products')}}</h3>

				<div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">

					<div class="clearfix"></div>
					<ul id="products_mix">
            @foreach (App\Product::all() as $item)
						<li class="simpleCart_shelfItem  @foreach($item->colors as $color) c_{{$color->id}} @endforeach g_{{$item->category}} s_{{$item->subcategory->id}} mix" >
							<a class="cbp-vm-image" href="{{$item->path()}}">
							 <div class="inner_content clearfix">
								<div class="product_image">
									<img src="{{asset($item->image_path())}}" class="img-responsive" alt="">
									<div class="product_container">
									   <div class="cart-left">
										 <p class="title">{{(App::isLocale('ar')) ? $item->arabic_name : $item->name}}</p>
									   </div>
									   <div class="price">{{$item->price}}</div>
									   <div class="clearfix"></div>
								     </div>
								  </div>
			                     </div>
		                    </a>
                        <div class="colors" style="
                             position: absolute;
                             top: 20px;
                             left: 20px;
                         ">
                          @if($item->colors->count() < 10)
                          @foreach ($item->colors as $color)
                           <div class="color" style="
                                 background-color: {{$color->code}};
                                 width: 15px;
                                 height: 15px;
                                 margin-bottom: 5px;
                                 border: 1px solid white;
                             "></div>
                            @endforeach
                          @else
                            <img src="http://www.thecolorwheel.org/img/new_icon.png" style="
                                width: 25px;
                                hieght: 15px;
                            ">
                          @endif
                         </div>
                         <br>
						</li>

          @endforeach

     <!-- <p style="font-weight: bold;"><a href="{{route('shop.index')}}">{{trans('layout.home_page')}}</a></p> -->




					</ul>
				</div>
				<script src="js/cbpViewModeSwitch.js" type="text/javascript"></script>
        <script src="js/classie.js" type="text/javascript"></script>
    </div>
  </div>
</div>
</div>

<script type="text/javascript">
$(function(){
  var $categorySelect = $('input[type=radio][name=category]'),
      $colorSelect = $('input[type=radio][name=colors]'),
      $categorySelect = $('input[type=radio][name=category]'),
      $container = $('#products_mix');
  $container.mixItUp({
    animation: {
        effects: 'fade translateZ(-100px)'
    }
  });

  $categorySelect.on('change', function(){
    $container.mixItUp('filter', this.value);

  });

  $colorSelect.on('change', function(){
    $container.mixItUp('filter', this.value);

  });

  $categorySelect.on('change', function(){
    $container.mixItUp('filter', this.value);

  });


});
</script>

@stop
