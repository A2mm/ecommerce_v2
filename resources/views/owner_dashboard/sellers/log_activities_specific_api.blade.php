@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">
    <h1>
      {{__('translations.log')}}
    </h1>
  </section>

  <!-- Main content -->

  <section class="content">

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
    </div><!-- /.box-header -->
     <table class="table table-bordered table-striped" id="vendors" style="font-size: 11px;">
      <thead>
        <tr class="success">
          <th>{{ 'ip' }}</th>
          <th>{{__('translations.url')}}</th>
          <th>{{__('translations.request')}}</th>
          <th>{{__('translations.response')}}</th>
          <?php // <th>{{__('translations.bill_id')}}</th> ?>
           <?php // <th>{{__('translations.user_name')}}</th> ?>
           <?php // <th>{{__('translations.user_phone')}}</th> ?>
          <th>{{__('translations.created_at')}}</th>
        </tr>
      </thead> 

      <tbody>
            <tr>
              <td> {{  $item->ip }} </td>
              <td> {{  stristr($item->url, '?', true) }} </td>
              <td>

                <?php $one = json_decode($item->request); ?>
                @foreach($one as $key => $value)
                 @if($key != 'api_token')

                    @if (is_array($value)) 
                      @if ($key = 'codes')  
                      <table class="table table-bordered table-striped" id="vendors" style="font-size: 11px;">

                        <thead>
                          <tr>
                            <th>{{__('translations.code')}}</th>
                            <th>{{__('translations.quantity')}}</th>
                          </tr>
                        </thead>

                        <tbody>

                        @foreach($value as $i)
                        <tr> 
                          <td> {{ $i->code }} </td> 
                          <td> {{ $i->quantity }} </td> 
                        </tr>
                          @endforeach
                     </tbody>
                   </table>
                    @endif 
                    @endif 
                    @endif 
                    @endforeach
              </td>
              <td> 

                <?php $one = json_decode($item->request); ?>

                 <?php $record = strstr($item->response, '{'); ?> 
                 <?php $record = json_decode($record); ?>
             
              @foreach($record as $key => $value)
               @if($key != 'apitoken')

              @if (is_array($value))
              @if ($key == 'products')
                
                     <table class="table table-bordered table-striped" id="vendors" style="font-size: 11px;">

                        <thead>
                          <tr>
                            <th>{{__('translations.name')}}</th>
                            <th>{{__('translations.unique_id')}}</th>
                            <th>{{__('translations.price')}}</th>
                            <th>{{__('translations.seller_quantity')}}</th>
                            <th>{{__('translations.product_total')}}</th>
                           
                          </tr>
                        </thead>

                        <tbody>

                        @foreach($value as $i => $g)
                        <tr>
                           <td> {{ $g->name }} </td>
                           <td> {{ $g->unique_id }}</td>
                           <td> {{ $g->price }} </td>
                           <td> {{ $g->seller_quantity }} </td>
                           <td> {{ $g->product_total }} </td>
                        </tr>
                        @endforeach
                     
                  </tbody>
                </table>
                    @endif 
                    @endif
                    @endif

                    
             

                @endforeach
              </td>

             
              
              <td>{{ $item->created_at }}</td>
            </tr>
          </tbody>
        </table>
          
</div>

      </div>

    </div>

  </section>





  

@stop
