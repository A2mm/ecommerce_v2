@extends('shop.master')
@section('body')

<div class="content_box" ng-controller= "currency_converter">
<div class="container">
  <div class="row">
    <div class="col-md-3">
      <div class="menu_box">
            <h3 class="menu_head">
            <button class="hamburger hamburger--collapse hidden-md hidden-lg is-active" type="button">
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
  

  <div class="form-group">
  <form id="subb"> 

        <input type="hidden" name="curr" value="{{request()->curr}}">
        <input type="hidden" name="gen" value="{{request()->gen}}">
     
       <select class="form-control" id="sub" name="sub">
        @foreach ($subcategories as $subcategory)

        <option value="{{$subcategory->id}}"
        @if(isset(request()->sub))
	        @if($subcategory->id == request()->sub)
	        	selected="selected"
	        @endif
        @endif
        >{{$subcategory->name}}</option>
      

        @endforeach
      <option value="ALL" @if(!isset(request()->sub) || request()->sub == 'ALL')selected="selected"@endif >All Subcategory</option>

     
        </select>
	
     
       <select class="form-control" id="acc" name="acc">
        @foreach ($accessories as $accessory)

        <option value="{{$accessory->id}}"
         @if(isset(request()->acc))
	        @if($accessory->id == request()->acc)
	        	selected="selected"
	        @endif
        @endif
        >{{$accessory->name}} </option>
      

        @endforeach
      <option value="ALL" @if(!isset(request()->acc) || request()->acc == 'ALL')selected="selected"@endif >All Accessories</option>

     
        </select>




	</form>

    </div>


 
 <!--<div class="form-group">
  <form id="subb"> 
	{!! Form::select('sub',$subcategories,request()->sub, ['class' => 'form-control', 'id' => 'sub']) !!}
	<input type="hidden" name="gen" value="{{request()->gen}}">
	</form>
 </div>-->
  <hr>

  <h3>
 

  {{--<label class="checkbox-inline"><input name="category" type="radio" value="{{
@foreach (App\Subcategory::all() as $sub)
	@if(!$loop->last)
         .s_{{$sub->id}},
     @endif
  .s_{{$sub->id}}
@endforeach}}">all</label> --}}


</div>
  <hr>

  @if($video->url)
  <h3>
    {{trans('layout.Video')}}
  </h3>
  
		

    <iframe width="100%" height="350px" src="https://www.youtube.com/embed/{{ $video_id }}?autoplay=
    <?php echo !$played; ?>&controls=1&showinfo=0" frameborder="0" allowfullscreen></iframe>

 
 
@endif





          
      </div>
    </div>
    <div class="col-md-9">
      <h3 class="m_1">{{trans('layout.All Products')}}</h3>
			    
				<div id="cbp-vm" class="cbp-vm-switcher cbp-vm-view-grid">
					
					<div class="clearfix"></div>
					<ul id="products_mix">
            @foreach ($new_products as $item)
						<li class="simpleCart_shelfItem  @foreach($item->colors as $color) c_{{$color->id}} @endforeach g_{{$item->category_id}} s_{{$item->subcategory->id}} mix" >
							<a class="cbp-vm-image" href="{{$item->path().getRequest()}}">
							 <div class="inner_content clearfix">
								<div class="product_image">
									<img src="{{asset($item->image_path())}}" class="img-responsive" alt="">
									<div class="product_container">
									   <div class="cart-left">
										 <p class="title">{{(App::isLocale('ar')) ? str_limit($item->arabic_name,16) : str_limit($item->name,14)}}</p>
									   </div>
									   <div class="price">
									   	@if (App::isLocale('ar')) 
					                        {{$item->price}}
					                        @else
					                        {{$item->price}}
					                        @endif
									   </div>
									   <div class="clearfix"></div>
								     </div>
								  </div>
			                     </div>
		                    </a>
             
						</li>
          @endforeach

  

						
					</ul>
					{{ $new_products->links() }}
				</div>
				<script src="js/cbpViewModeSwitch.js" type="text/javascript"></script>
        <script src="js/classie.js" type="text/javascript"></script>
    </div>
  </div>
</div>

 <select class="form-control" id="dynamic_select">
        <option value="" select="selected">Choose a Subcategory to know more about it</option>
        @foreach ($subcategories as $subcategory)
        

        <option value="{{$subcategory->path().getRequest()}}">{{$subcategory->name}}
        </option>
        @endforeach
       
        </select>

        <form class="navbar-form navbar-left" role="Search" action="{{route('shop.search').getRequest()}}" method="post">
        <div class="form-group">
          <input type="text" name="query" class="form-control" placeholder="Find people">
        </div>
        <button type="submit" class="btn btn-default">Search</button>
      </form>


   

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

<script type="text/javascript">
   $("#sub").change(function() {
     $("#subb").submit();

   });
  
</script>

</script>

<script type="text/javascript">
   $("#acc").change(function() {
     $("#subb").submit();

   });
  
</script>


<script>
    $(function(){
      // bind change event to select
      $('#dynamic_select').on('change', function () {
          var url = $(this).val(); // get selected value
          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>


@stop
