@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
      {{trans('layout.All Customers')}}
    </h1>
  </section>
<div class="product_movement" style="padding: 25px; border-radius: 25px; width: 600px;">
     
      <form class="form" method="get" action="{{route('manage.get.usertype.history')}}">
            {{ csrf_field() }}

<div class="form-group">
              <label>{{ __('translations.choose_user_type') }}</label>
              <select name="usertype_id" class="form-control">
                @foreach($usertypes as $usertype)
                <option value="{{$usertype->id}}" {{$usertype->id == $id ? 'selected' : ''}}> {{ $usertype->name }} </option>
                @endforeach
              </select>              
</div>

<div class="form-group">
   <button type="submit" class="btn btn-xs btn-success">{{ __('translations.search') }}</button>     
</div>
            
       </form> 
    </div>

    <table class="table table-bordered table-striped" id="customers">
    <thead>
      <tr>
        <th>{{__('translations.name')}}</th>
        <th>{{__('translations.phone')}}</th>
        <th>{{__('translations.user_type')}}</th>
        <th>{{__('translations.points')}}</th>
        <th>{{__('translations.actions')}}</th>
      </tr>
    </thead>
    <tbody>
      <?php/*
           
    */?>
    </tbody>
  </table>

@stop