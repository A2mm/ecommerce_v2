@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
      {{trans('layout.All categories')}}

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

  <table class="table table-bordered table-striped " id="categories">
    <thead>
      <tr>
        <th style="text-align: right;">{{__('translations.name')}}</th>
        <?php // <th style="text-align: right;">{{__('translations.cats/prods')}}</th> ?>
        <th style="text-align: right;">{{__('translations.actions')}}</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($categories as $category)
        <tr>
          <td>{{ $category->name }}</td>
           <?php // <td>{{ 'subcats: '.$category->hasSubcategories(). 'and prods:'.$category->hasProducts() }}</td> ?>
          <td>
            
            @if($user->can('edit category') || $user->can('Administer'))
               <a href="{!! route('manage.category.edit', ['id' => $category->id]) !!}" class="btn btn-xs btn-primary">
                        {{trans('layout.Edit')}}</a> 
                     
            @endif

             @if ($category->hasProducts() < 1) 
             @if ($category->hasSubcategories() < 1)
           <?php // @role('editor') ?>
        
              @if($user->can('delete category') || $user->can('Administer'))
              <a data-href="{{route('manage.category.delete', ['id' => $category->id])}}" class="delete btn btn-xs btn-danger">{{trans('layout.Delete')}} </a>
               @endif
              
             <?php // @endrole ?>
            @endif
            @endif
             <input type="hidden" name="row" value="' . $category->id . '" id="row"></td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>
      </div>
    </div>
  </section>
@stop
