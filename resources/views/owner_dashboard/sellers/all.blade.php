@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">
    <h1>
    {{__('translations.all_sellers')}}
    </h1>
  </section>


  <!-- Main content -->

  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
      <a style="height: 33px;" class="btn btn-sm btn-success" href="{{ route('excel.sellers') }}">
        اكسل <i class="fa fa-file-excel-o" aria-hidden="true"></i> </a>
    </div><!-- /.box-header -->

     <?php $user = Auth::user(); ?>

  <table class="table table-bordered table-striped" id="subcategories">

    <thead>
      <tr>
        <th style="text-align: right;">{{__('translations.name')}}</th>
        <th style="text-align: right;">{{__('translations.email')}}</th>
        <th style="text-align: right;">{{__('translations.store')}}</th>
        <th style="text-align: right;">{{__('translations.actions')}}</th>
      </tr>

    </thead>

    <tbody>
    @foreach($sellers as $seller)
            <tr>
              <td>{{$seller->name}}</td>
              <td>{{$seller->email}}</td>
              <td>{{$seller->store->name}}</td>
              <td>

               @if($user->can('view specific seller') || $user->can('Administer'))
              <a href="{{route('manage.sellers.view',['id' => $seller->id])}}" class="btn btn-xs btn-primary">{{__('translations.view')}}</a>
              @endif

              @if($user->can('edit seller') || $user->can('Administer'))
              <a href="{{route('manage.sellers.edit',['id' => $seller->id])}}" class="btn btn-xs btn-primary">{{__('translations.edit')}}</a>
              @endif

              @if($user->can('suspend seller') || $user->can('Administer'))
              <a href="{{route('manage.sellers.suspend',['id' => $seller->id])}}" class="btn btn-xs btn-danger">
              @if($seller->suspend==1)
              {{__('translations.un_suspend')}}
              @else
              {{__('translations.suspend')}}
              @endif
              </a>
              @endif

              @if($user->can('seller sold') || $user->can('Administer'))
               <a href="{{route('sellers.soldprods',['id' => $seller->id])}}" class="btn btn-xs btn-info">{{__('translations.sold')}}</a>
               @endif

               @if($user->can('seller kilo history') || $user->can('Administer'))
               <a href="{{route('sellers.kilo',['id' => $seller->id])}}" class="btn btn-xs btn-warning">{{__('translations.sold_kilo')}}</a>
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
