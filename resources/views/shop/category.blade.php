@extends('shop.master')

@section('body')

  <div class="content_box">

  <div class="container">

    <div class="row">

      {{--<div class="col-md-3">

        <div class="menu_box">

              <h3 class="menu_head">{{trans('layout.Subcategories')}}
<button class="hamburger hamburger--collapse hidden-md hidden-lg" type="button">
  <span class="hamburger-box">
    <span class="hamburger-inner"></span>
  </span>
</button>
</h3>

              <ul class="nav">

                @forelse ($subcategories as $sub)

                  <li><a href="{{$sub->path().getRequest()}}">{{(App::isLocale('ar')) ? $sub->arabic_name : $sub->name}}</a></li>

                @empty

                <li>{{trans('layout.No_categories')}}</li>

              @endforelse

             </ul>

        </div>

      </div>--}}

      <div class="col-md-9">




   {{--<div class="mens-toolbar">

             <ul class="women_pagenation dc_paginationA dc_paginationA06">

               {{ $products->links() }}



           </ul>

               <div class="clearfix"></div>

          </div>--}}

        <!--<h3 class="m_1">{{trans('layout.New_Products')}}</h3>-->

         <div class="content_grid">



           @forelse($products as $item)

            @if (($loop->index) % 3 == 0)

               <div class="content_grid">

            @endif

           <div class="col_1_of_3 simpleCart_shelfItem">

               <a href="{{$item->path().getRequest()}}">

               <div class="inner_content clearfix">

              <div class="product_image">

                <img src="{{asset($item->image_path())}}" class="img-responsive" alt=""/>



                 <div class="product_container">

                   <div class="cart-left">

                   <p class="title">{{(App::isLocale('ar')) ? $item->arabic_name : $item->name}}</p>

                   </div>

                   <span class="amount item_price">{{$item->price}}
                     {{--@if (App::isLocale('ar'))
                      {{$item->price}} {{$item->currency->arabic_name or ''}}
                      @else
                      {{$item->price}} {{$item->currency->name or ''}}
                      @endif--}}
                   </span>

                   <div class="clearfix"></div>

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

          <p>{{trans('layout.No_Products')}}</p>

          @endforelse

        </div>

        <div class="mens-toolbar">



              <ul class="women_pagenation dc_paginationA dc_paginationA06">


                {{ $products->appends(getRequestBetweenPages())->links() }}



            </ul>

                <div class="clearfix"></div>

           </div>

    </div>

  </div>

  <!-- <p style="font-weight: bold;"><a href="{{url('/index').getRequest()}}">{{trans('layout.home_page')}}</a></p> -->

  </div>

@stop
