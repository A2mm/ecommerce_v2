@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">

    <h1>

    {{__('translations.all_stores')}}

    </h1>

  </section>



  <!-- Main content -->

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
      <a style="height: 33px;" class="btn btn-sm btn-success" href="{{ route('excel.stores') }}">
        اكسل <i class="fa fa-file-excel-o" aria-hidden="true"></i> </a>
    </div><!-- /.box-header -->

     <?php $user = Auth::user(); ?>

  <table class="table table-bordered table-striped" id="stores">
    <thead>
      <tr>
        <th style="text-align: right;">{{__('translations.name')}}</th>
        <th style="text-align: right;">{{__('translations.address')}}</th>
        <!-- <th>{{__('translations.vendor')}}</th> -->
        <th style="text-align: right;">{{__('translations.actions')}}
      </tr>
    </thead>
    <tbody>
    @foreach($stores as $store)
            <tr>
              <td>{{$store->name}}</td>
              <td>{{$store->address}}</td>
              <td>

                @if($user->can('edit store') || $user->can('Administer'))
              <a href="{{route('manage.store.edit',['id' => $store->id])}}" class="btn btn-xs btn-primary">{{__('translations.edit')}}</a>
              @endif

               @if($store->sellers->count() <= 0)
               @if($store->product_store_quantity->count() <= 0)
               @if($user->can('delete store') || $user->can('Administer'))

            <a href="{{route('manage.store.delete',['id' => $store->id])}}" class="delete btn btn-xs btn-danger" data-href="{{route('manage.store.delete',['id' => $store->id])}}">{{__('translations.delete')}}</a>
              @endif
              @endif
              @endif

               @if($user->can('view store quantities') || $user->can('Administer'))
              <a href="{{route('manage.store.show',['id' => $store->id])}}" class="btn btn-xs btn-info">{{__('translations.view')}}</a>
               @endif

              @if($user->can('view store purchases') || $user->can('Administer'))
              <a href="{{route('manage.store.purchases',['id' => $store->id])}}" class="btn btn-xs btn-success">{{__('translations.purchases')}}</a>
              @endif

              @if($user->can('view store products movements') || $user->can('Administer'))
              <a href="{{route('manage.store.movements',['id' => $store->id])}}" class="btn btn-xs btn-primary">{{__('translations.product_movements')}}</a>
              @endif

               @if($user->can('view store sellers') || $user->can('Administer'))
              <a class="btn btn-xs btn-primary" style="color: white;" href="{{route('manage.store.sellers',['id' => $store->id])}}" class="btn btn-xs">{{__('translations.sellers')}}</a>
              @endif
              <br>

               @if($user->can('print store week') || $user->can('Administer'))
              <a style="background: rgb(82, 163, 163); color: white; margin-top: 5px;" href="{{route('manage.store.print.week',['id' => $store->id])}}" class="btn btn-xs">{{__('translations.print_week')}}</a>
              @endif

               @if($user->can('store ship order') || $user->can('Administer'))
              <a style="background: rgb(82, 163, 163); color: white; margin-top: 5px;" class="btn btn-xs" href="{{route('manage.products.ship.order', ['id' => $store->id])}}"> {{__('translations.ship_order')}} </a>
              @endif

              @if($user->can('transfer order') || $user->can('Administer'))
              <a style="background: rgb(82, 163, 163); color: white; margin-top: 5px;" href="{{route('manage.store.transferorder',['id' => $store->id])}}" class="btn btn-xs">{{__('translations.transfer_order')}}</a>
              @endif

              @if($user->can('refund stock') || $user->can('Administer'))
              <a style="background: rgb(82, 163, 163); color: white; margin-top: 5px;" href="{{route('refund.stock',['id' => $store->id])}}" class="btn btn-xs">{{__('translations.refund_order')}}</a>
              @endif

              @if($user->can('settle stock') || $user->can('Administer'))
              <a style="background: rgb(82, 163, 163); color: white; margin-top: 5px;" href="{{route('settle.stock',['id' => $store->id])}}" class="btn btn-xs">{{__('translations.settle_order')}}</a>
              @endif

              </td>
            </tr>
    @endforeach
    </tbody>

  </table>

</div>

      </div>

    </div>

  </section>

@stop
