@extends('shop.master') @section('body')
<div class="content_box">
    <div class="container">
        <div class="row">
           <!--FILTER-->
            <div class="col-md-3" style="position:relative; top:-100px;">
                <div class="menu_box">
                    <h3 class="menu_head">Subcategorys
                       <button class="hamburger hamburger--collapse hidden-md hidden-lg" type="button">
                         <span class="hamburger-box">
                           <span class="hamburger-inner"></span>
                         </span>
                       </button>
                    </h3>
                    <ul class="nav">
                        @forelse ($subcategories as $sub)
                        <li><a class="{{($id == $sub->id) ? 'active' : ''}}" href="{{$sub->path().getRequest()}}">{{(App::isLocale('ar')) ? $sub->arabic_name : $sub->name}}</a></li>
                        @empty
                        <li>{{trans('layout.No_categories')}}</li>
                        @endforelse
                    </ul>
                </div>
            </div>
            <!---->
            <div class="col-md-9">
                <div class="disc">
                    <img src="{{asset('shop_images/subcategories/'.$subcategory->image)}}" alt="" />
                    <article>
                        <h3>{{(App::isLocale('ar')) ? $subcategory->arabic_name : $subcategory->name}}</h3>
                        <p>
                            @if (App::isLocale('ar')) @if ($subcategory->arabic_description) {{$subcategory->arabic_description}} @else {{$subcategory->description}} @endif @else {{$subcategory->description}} @endif
                        </p>
                    </article>
                </div>

                @if(count($suppliers))
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>Supplier Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                    </tr>
                    @foreach($suppliers as $supplier)
                    <tr>
                        <th>{{$supplier->name}}</th>
                        <th>{{$supplier->email}}</th>
                        <th>{{$supplier->phone}}</th>
                    </tr>
                    @endforeach
                </table>
                @endif
            </div>
            <!---->
        </div>
        <!-- <p style="font-weight: bold;"><a href="{{url('/index').getRequest()}}">{{trans('layout.home_page')}}</a></p> -->
    </div>
</div>
@stop
