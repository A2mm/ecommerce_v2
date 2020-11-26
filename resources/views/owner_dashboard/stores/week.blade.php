@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">

    <h1>

    {{__('translations.purchases')}}

    </h1>

  </section>

  <!-- Main content -->

  <section class="content">

    <div class="row">

      <div class="col-xs-12">

        <div class="box">

    <div class="box-header" style="padding-top:0;">

      <h3 class="box-title"></h3>

    </div><!-- /.box-header -->

    <div class="">
      <?php /* <a href="{{route('manage.store.week.pdf', ['id' => $store->id])}}" class="btn btn-xs btn-danger">{{__('translations.generate_to_pdf')}}</a>
      */ ?>

<a class="btn  btn-primary" style="cursor: pointer; margin: 15px;" onclick="print()" >{{__('translations.print')}}</a>
<a style="height: 33px;" class="btn btn-sm btn-success" href="{{ url('/excel/store/week?id=' . $store->id)}}">
  اكسل <i class="fa fa-file-excel-o" aria-hidden="true"></i> </a>


    </div>

  <!-- Main content -->
  <div id="bar">
                  <table class="table table-bordered table-striped">
                    <thead>
                      <tr class="success">
                        <th style="text-align: right;">{{__('translations.product_name')}}</th>
                        <th style="text-align: right;">{{__('translations.unique_id')}}</th>
                        <th style="text-align: right;">{{__('translations.quantity')}}</th>
                        <th style="text-align: right;">{{__('translations.price')}}</th>
                        <th style="text-align: right;">{{__('translations.seller_name')}}</th>
                        <th style="text-align: right;">{{__('translations.store_name')}}</th>
                        <th style="text-align: right;">{{__('translations.client_name')}}</th>
                        <th style="text-align: right;">{{__('translations.bill_id')}}</th>
                        <th style="text-align: right;">{{__('translations.status')}}</th>
                        <th style="text-align: right;">{{__('translations.payment_method')}}</th>
                        <!-- <th style="text-align: right;">{{__('translations.purchase_status')}}</th> -->
                        <th style="text-align: right;">{{__('translations.created_at')}}</th>

                      </tr>
                    </thead>
                    <tbody>
                      @foreach($histories as $history)
                      <tr>
                      <td>{{ $history->product->name }}</td>
                      <td>{{ $history->product->unique_id }}</td>
                      <td>{{ $history->quantity }}
                        <?php //{{ $history->quantity < 0 ? -$history->quantity : $history->quantity }} ?></td>
                      <td>
                        {{ $history->price }}
                       <?php  // {{ $history->price - ($history->price * $history->sellerdiscount / 100) }}?>
                      {{ __('translations.egp') }}</td>
                      <td>{{ $history->seller->name }}</td>
                      <td>{{ $history->store->name }}</td>
                      <td>@if(!empty($history->user->name))
                          {{$history->user->name}} <br>
                          ( {{$history->user->usertype->name}} )
                          @else
                          {{ __('translations.unregistered_client')}}
                          @endif</td>
                      <td>{{ $history->bill_id }}</td>
                      <td>{{ $history->order_status }}</td>
                      <td>{{ 'نقدي في المتجر' }}</td>
                      <td>{{ $history->created_at }}</td>
                      </tr>
                      @endforeach


                    </tbody>
                  </table>
</div>

            <?php //  {!! $histories->appends(["from" => $from, "to" => $to])->render() !!}  ?>
                  </div>

                        </div>

                      </div>

                    </section>

<script>

    function print() {
      // alert('asdasd');
        // var mode = 'iframe';
        // var close = mode == "popup";
        // var options ={mode : mode, popClose : close };
        // $("#bar").printArea(options);


        var divToPrint=document.getElementById('bar');
        var newWin=window.open('','Print-Window');
        newWin.document.open();
        newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
        newWin.document.close();
        setTimeout(function(){newWin.close();},1);

    }

  </script>

                  @stop
