@extends('owner_dashboard.master')
@section('body')

<section class="content-header">
  <h1>
    {{ __('translations.all_onlinecategories')}}
  </h1>
</section>
<style type="text/css">
  .actionsmenu li a {
    font-size: 12px;
    padding-bottom: -55px;
  }

  .actionsmenu li {
    margin: -5px;
  }

  .actionsmenu li a:hover {
    background: blue;
  }
</style>
<!-- Main content -->

     <?php $user = Auth::user(); ?> 

<section class="content">
  <div class="row">
    <div class="col-xs-12">
        
        <?php $user = Auth::user(); ?>

        <br>
    <div id="dynamic_content">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th style="text-align: right;"> {{ __('translations.name') }} </th>
            <th style="text-align: right;">{{__('translations.created_at')}}</th>
            <th style="text-align: right;">{{__('translations.actions')}}</th>
          </tr>
        </thead>
        <tbody id="table_body">
          @foreach ($categories as $key => $item)
            <tr>
              <td>{{$item->name}}</td>
              <td>{{$item->created_at}}</td>
              <td>
                 @if($user->can('categories online edit') || $user->can('Administer'))
                <a href="{{route('categories.online.edit' , $item->id)}}" class="btn btn-primary">تعديل</a>
                 @endif

                 @if($user->can('categories online destroy') || $user->can('Administer'))
                  @if($item->products->count() <= 0)
                <a href="{{route('categories.online.destroy' , $item->id)}}" class="btn btn-danger" onclick="return confirm(&quot;{{'تأكيد الحذف'}}&quot;)">حذف</a>
                 @endif
                 @endif

              </td>
            </tr>
          @endforeach


        </tbody>
      </table>
      {{-- {!! $products->appends(['search_index' => $search_index])->render() !!} --}}
    </div>


  </div>
  </div>
  
</section>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
@stop
