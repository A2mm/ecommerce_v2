@extends('owner_dashboard.master')
@section('body')

  <section class="content-header">
    <h1>
      {{ __('translations.tags') }}
    </h1>
  </section>
<style type="text/css">
  .actionsmenu li a{
    font-size: 12px;
    padding-bottom: -55px;
  }
  .actionsmenu li {
    margin: -5px;
  }
   .actionsmenu li a:hover{
    background: blue;
  }
</style>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
    </div><!-- /.box-header -->

     <?php $user = Auth::user(); ?>
             
<div id="dynamic_content">

@if($user->can('create tag') || $user->can('Administer'))
            <a class="btn btn-success" href="{{route('product.createtag',['id' => $product->id])}}">{{ 'انشاء تاج ' }}</a> <br>
@endif
  <table class="table table-bordered table-striped" style="margin-top: 15px;">
    <thead>
      <tr>
        <th style="text-align: right;"> {{ __('translations.product') }} </th>
        <th style="text-align: right;">{{__('translations.tag')}}</th>
        <th style="text-align: right;">{{__('translations.created_at')}}</th>
        <th style="text-align: right;">{{trans('layout.Actions')}}</th>
      </tr>
    </thead>
    <tbody id="table_body">


         @foreach($tags as $tag)
            <tr>
              <td>{{ $tag->product->name}}</td>
              <td>{{ $tag->tag }}</td>
              <td>{{ $tag->created_at}}</td>
              <td>
              
@if($user->can('edit tag') || $user->can('Administer'))
            <a class="btn btn-primary" href="{{route('product.edittag',['id' => $tag->id])}}" class="btn btn-xs ">{{__('translations.edit')}}</a>
@endif

@if($user->can('delete tag') || $user->can('Administer'))
              <a class="delete btn btn-danger" href="{{route('product.deletetag',['id' => $tag->id])}}" class="btn btn-xs " data-href="{{route('product.deletetag',['id' => $tag->id])}}">{{__('translations.delete')}}</a>
 @endif


              </td>

            </tr>
    @endforeach

  </tbody>
  </table>
   </div>

</div>
      </div>
    </div>
  </section>


@stop
