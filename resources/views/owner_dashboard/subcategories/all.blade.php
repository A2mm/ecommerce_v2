@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">
    <h1>
    {{__('translations.all_subcategories')}}
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

      <?php $user = Auth::user(); ?>

  <table class="table table-bordered table-striped" id="subcategories">
    <thead>
      <tr>
        <th style="text-align: right;">{{__('translations.name')}}</th>
        <th style="text-align: right;">{{__('translations.num_of_products')}}</th>
        <th style="text-align: right;">{{__('translations.actions')}}</th>
      </tr>
    </thead>
    <tbody>
    @foreach($subcategories as $sub_cat)
            <tr>
              <td>{{$sub_cat->name}}</td>
              <td>{{count($sub_cat->products)}}</td>
              <td>
                
                 @if($user->can('view specific subcategory') || $user->can('Administer'))
            <a href="{{route('manage.subcategory.view',['id' => $sub_cat->id])}}" class="btn btn-xs btn-primary">{{__('translations.view')}}</a>
              @endif

               @if($user->can('edit subcategory') || $user->can('Administer'))
              <a href="{{route('manage.subcategory.edit',['id' => $sub_cat->id])}}" class="btn btn-xs btn-primary">{{__('translations.edit')}}</a>
              @endif

              @if($sub_cat->products->count() <= 0)
               @if($user->can('delete subcategory') || $user->can('Administer') )
              <a data-href="{{route('manage.subcategory.delete',['id' => $sub_cat->id])}}" class="delete btn btn-xs btn-danger">{{__('translations.delete')}}</a>
              @endif
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
