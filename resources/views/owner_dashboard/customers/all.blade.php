@extends('owner_dashboard.master')
@section('body')
<section class="content-header">
  <h1>
    {{trans('layout.All Customers')}}
    <?php /* <span class="badge" style="background: green; font-size: 15px; color:white;">
        {{ count($customers) }}  </span> */ ?>
  </h1>
</section>

<style type="text/css">
.searchButton{
    height : 35px; 
    padding: 10px;
    width: 85px;
    border: 0px;
    color: #fff;
    box-shadow: 0 0 1px #ccc;
    -webkit-transition-duration: 0.5s;
    -webkit-box-shadow: 0px 0px 0 0 #31708f inset , 0px 0px 0 0 #31708f inset;
  }
  .searchButton:hover{
    -webkit-box-shadow: 50px 0px 0 0 pink inset , -50px 0px 0 0 pink inset;
    content: 'ahmed';
  }
</style>

<?php $logged_user = Auth::user(); ?>

<div class="row">
  <div class="col-md-10">

<div class="product_movement" style="padding: 25px; border-radius: 25px; width: 600px;">


  <form class="form" method="get" action="{{route('manage.customers.all')}}">

    <div class="row"> 
              <div class="col-md-4">
                      <div class="form-group">&nbsp;&nbsp;
                    <label>{{ __('translations.all_users') }}</label>
                    <select name="usertype_id" class="form-control">
                       <option selected="selected" value=""> {{ __('translations.all_users') }} </option>
                      @foreach($usertypes as $usertype)
                      <option value="{{$usertype->id}}" {{$usertype->id == $type ? 'selected' : ''}}> {{ $usertype->name }} </option>
                      @endforeach
                    </select>              
                  </div>
              </div>

              <div class="col-md-4">
                <div class="form-group">
                   &nbsp;&nbsp;&nbsp; <label>{{ __('translations.search_name_phone') }}</label>
                  <input type="text" name="search_index" value="{{$search_index}}" class="form-control">
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <label>{{ __('translations.search') }}</label><br>
                  <button type="submit" class="btn btn-sm btn-primary searchButton">
                     {{ __('translations.search') }} <i class="fa fa-search"></i></button>     
                  </div>
              </div>

            </div>

  </form>
  <a href="{{route('excel.customers')}}" class="btn btn-success">اكسل <i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
</div>
<!-- Main content -->

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"></h3>
        </div><!-- /.box-header -->
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th style="text-align: right;">{{__('translations.name')}}</th>
              <th style="text-align: right;">{{__('translations.phone')}}</th>
              <th style="text-align: right;">{{__('translations.user_type')}}</th>
              <th style="text-align: right;">{{__('translations.count_checkout_purchased')}}</th> 
              <th style="text-align: right;">{{__('translations.created_at')}}</th>
              <th style="text-align: right;">{{__('translations.actions')}}</th>
            </tr>
          </thead>
          <tbody>
            @foreach($customers as $customer)

            <tr>

              <td>{{$customer->name}}</td>
              <td>
                @if($customer->phone != null)
                 {{ $customer->phone }}
                @else
                {{ 'لا يوجد رقم تليفون بعد' }}
                @endif
              </td>
              <td>
                       @if($customer->usertype_id == null)
                       {{ 'قطاعي' }}
                      @else
                      {{ $customer->usertype->name }}
                      @endif
              </td>
              <?php /* <td>{{$customer->email}}</td>
=======
    <div class="product_movement" style="padding: 25px; border-radius: 25px; width: 600px;">


      <form class="form" method="get" action="{{route('manage.customers.all')}}">
        <div class="row">
          <div class="col-md-4">

            <div class="form-group">
              <label>{{ __('translations.all_users') }}</label>
              <select name="usertype_id" class="form-control">
                <option selected="selected" value=""> {{ __('translations.all_users') }} </option>
                @foreach($usertypes as $usertype)
                <option value="{{$usertype->id}}" {{$usertype->id == $type ? 'selected' : ''}}> {{ $usertype->name }} </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>{{ __('translations.search_name_phone') }}</label>
              <input type="text" name="search_index" value="{{$search_index}}" class="form-control">
            </div>
          </div>
          <div class="col-md-2" style="padding-top:32px;">
            <div class="form-group">
              <button type="submit" class="btn btn-xs btn-primary">{{ __('translations.search') }} <i class="fa fa-search"></i></button>
            </div>
          </div>
        </div>

      </form>
      <a href="{{route('excel.customers')}}" class="btn btn-success">اكسل <i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
    </div>
    <!-- Main content -->

    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div><!-- /.box-header -->
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th style="text-align: right;">{{__('translations.name')}}</th>
                  <th style="text-align: right;">{{__('translations.phone')}}</th>
                  <th style="text-align: right;">{{__('translations.user_type')}}</th>
                  <th style="text-align: right;">{{__('translations.total')}}</th> 
                  <th style="text-align: right;">{{__('translations.created_at')}}</th>
                  <th style="text-align: right;">{{__('translations.actions')}}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($customers as $customer)

                <tr>

                  <td>{{$customer->name}}</td>
                  <td>{{$customer->phone}}</td>
                  <td>{{$customer->usertype->name ?? 'user' }}</td>
                  <?php /* <td>{{$customer->email}}</td>
>>>>>>> 500869d012f5af40f1de1611ba53c72e3b358bdc
              <td>{{$customer->role}}</td>
              <td>{{$customer->usertype['name'] }}</td> */ ?>

                  <?php //  <td>{{$customer->points}}</td> ?>
                  <?php /* <td>
                <img style="margin-top: -10px;" src="{{asset($customer->image)}}" alt="{{__('translations.No_image_Selected')}}" width="30px" height="30px" class="img img-circle" style="border:1px solid black; margin-top: 25px;">
              </td> */ ?>
                  <td>
                    <?php 
                    $total_price_bought = App\History::where('user_id', $customer->id)
                                                              ->where('order_status' , '!=', 'in progress')
                                                              ->where('order_status' , '!=', 'pending')
                                                              ->where('order_status' , '!=', 'canceled')
                                                              ->sum('price'); 
                                                              
                        $bought = round($total_price_bought, 10); 

                        $count_purchases_shipments = App\History::where('price', '>', 0)
                                          ->where('user_id', $customer->id)
                                          ->where('order_status' , 'delivered')
                                          ->where('order_status' , '!=', 'pending')
                                          ->where('order_status' , '!=', 'canceled')
                                          ->get();

                      $purchases_shipments       = $count_purchases_shipments->pluck('purchase_id');
                      $sum_purchases_shipments   = App\Purchase::whereIn('id', $purchases_shipments)->sum('shipment');


                     $sum_purchases_shipments_all = round($sum_purchases_shipments, 10); 
                    ?>
                    @if(strstr($bought, '-'))
                    {{ -$bought + $sum_purchases_shipments_all}}
                    @else
                    {{ $bought + $sum_purchases_shipments_all }}
                    @endif
                    {{ __('translations.egp') }}
                  </td>

                  <td>{{$customer->created_at}}</td>

                  <td>
                    @if($customer->prev_privillige!=NULL)
                      @if($customer->prev_privillige=='vendor')
                        <a href="{{route('manage.vendors.unblock', ['id' => $customer->id])}}" class="btn btn-xs btn-danger">{{__('translations.un_suspend_vendor')}}</a>

                        @elseif($customer->prev_privillige=='affiliate')
                          <a href="{{route('manage.affiliate.unblock', ['id' => $customer->id])}}" class="btn btn-xs btn-danger">{{__('translations.un_suspend_affiliate')}}Affiliate</a>
                          @endif
                          @endif

                          <?php /* @if($customer->deleted_at==NULL)
                @if($customer->prev_privillige==NULL) */ ?>

                          @if($customer->suspend == 0)
                            @if($logged_user->can('view customer profile data') || $logged_user->can('Administer'))
                              <a href="{{route('manage.customers.viewprofile',['id' => $customer->id])}}" class="btn btn-xs btn-info">{{__('translations.view')}}</a>
                              @endif
                              @endif


                              @if($customer->suspend == 0)
                                @if($logged_user->can('edit customer') || $logged_user->can('Administer'))
                                  <a href="{{route('manage.customers.edit',['id' => $customer->id])}}" class="btn btn-xs btn-primary">{{__('translations.edit')}}</a>
                                  @endif
                                  @endif

                                  <?php /*  @if($logged_user->can('suspend customer') || $logged_user->can('Administer'))
                <a data-href="{{route('manage.customers.block',['id' => $customer->id])}}" class="suspend btn btn-xs btn-danger">{{__('translations.suspend')}}</a>
                 @endif */ ?>

                                  @if($customer->suspend == 0)
                                    @if($logged_user->can('show customer orders') || $logged_user->can('Administer'))
                                      <a href="{{route('manage.customers.details',['id' => $customer->id])}}" class="btn btn-xs btn-success">{{__('translations.show_orders')}}</a>
                                      @endif
                                      @endif

                                      @if($customer->suspend == 0)
                                        @if($logged_user->can('suspend customer') || $logged_user->can('Administer'))
                                          <a data-href="{{route('manage.customers.block',['id' => $customer->id])}}" class="suspend btn btn-xs btn-danger">{{__('translations.suspend')}}</a>
                                          @endif
                                          @endif

                                          @if($customer->suspend == 1)
                                            @if($logged_user->can('unsuspend customer') || $logged_user->can('Administer'))
                                              <a href="{{route('manage.customers.unblock',['id' => $customer->id])}}" class="btn btn-xs btn-warning">{{__('translations.un_suspend')}}</a>
                                              @endif
                                              @endif

                                              {{--@if($customer->role=='vendor')
                <a href="{{route('manage.vendors.block', ['id' => $customer->id])}}" class="btn btn-xs btn-danger">Suspend Vendor</a>
                                              @elseif($customer->role=='affiliate')
                                                <a href="{{route('manage.affiliate.block', ['id' => $customer->id])}}" class="btn btn-xs btn-danger">حظر كمروج</a>
                                                @endif--}}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>


            <?php // {{ $customers->links() }} ?>
            {!! $customers->appends(["usertype_id" => $type, 'search_index' => $search_index])->render() !!}
          </div>
        </div>
      </div>
  </div>
  </section>
<?php /*  
      <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

  <script type="text/javascript">
    $(document).ready(function() {
    $('.searchButton').hover(function() {
      // $(this).html(' <span style="font-size: 25px; color:red;">أحمد   </span>');
      $(this).html(' <span style="font-size: 16px; color:red;"> رمضان كريم  </span>');
    }, function() {
      $(this).html('بحث');
    });
  });
  </script>
  */ ?>
  @stop
