@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">
    <h1>
      {{__('translations.userroles_getlog')}}
    </h1>
  </section>

  <br>
  <div class="row">
  <div class="col-md-9">

              <form class="form form-horizontal" method="get" action="{{route('userroles.getlog')}}">
  <div class="row">
  
  <div class="col-md-3"> 
  &nbsp; <b> {{__('translations.day')}} </b>
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 ( {{ 'سنة/يوم/شهر' }} )
  <input type="date" class="form-control" name="search_day" value="{{$search_day}}" style="display: inline-block;"> 
  </div>

 <div class="col-md-3"> 
  &nbsp; <b> {{ __('translations.from_hour') }} </b>
 <input type="time" class="form-control" name="from_hour" value="{{$from_hour}}" style="display: inline-block;"> 
 </div>
 
 <div class="col-md-3"> 
  &nbsp; <b> {{ __('translations.to_hour') }} </b>
  <input type="time" class="form-control" name="to_hour" value="{{$to_hour}}" style="display: inline-block;"> 
 </div>
 
 <div class="col-md-1"> <br>
  <button style="height: 33px;" type="submit" class="btn btn-sm btn-primary"> <i class="fa fa-search"></i> {{ __('translations.search') }}</button> 
 </div>

</div>
</form>
</div>
 
<div class="col-md-2 sub">
  <br>
   <a style="height: 33px;" class="btn btn-sm btn-warning back_home" href="{{ route('userroles.getlog') }}"> 
     {{ __('translations.back_home') }} <i class="fa fa-refresh"></i> </a> 
</div>

<div class="col-md-2 sub">
  <br>
 <a style="height: 33px;" class="btn btn-sm btn-success" href="{{route('giveRolesLog.excel')}}">
       {{ __('translations.excel') }}
    <i class="fa fa-file-excel-o" aria-hidden="true"></i> </a> 
</div>

</div>

  <!-- Main content -->

  <section class="content">

    <div class="row">
      <div class="col-xs-12">
        <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
    </div><!-- /.box-header -->
    <table class="table table-bordered table-striped" id="vendors">
      <thead>
        <tr>
          <th style="text-align: right;"> {{__('translations.description')}}</th>
         <?php //  <th>{{__('translations.subject_id')}}</th> ?>
         <?php //  <th>{{__('translations.subject_type')}}</th> ?>
         <th style="text-align: right"> {{ __('translations.ip') }}</th>
         <th style="text-align: right">  {{ __('translations.created_at') }} </th>
          <th style="text-align: right"> {{__('translations.actions')}}</th>
        </tr>
      </thead>

      <tbody>
      @foreach($logged_requests as $key => $activity)                  
                <?php  $item = json_decode($activity->request); ?>
                        <tr> 
                            <td>
                             {{ __('translations.userroles_getlogged') }} 
                             @foreach ($item as $key => $value)
                                @if($key == 'admin_id') 
                                 <?php $admin = App\User::withTrashed()->where('id', $value)->first(); ?>
                                 ( {{  $admin->name }} )
                                @endif
                            @endforeach
                            </td> 
                            <td> {{ $activity->ip }}</td>
                            <td> {{ $activity->created_at }} 
                              <u> {{ $activity->created_at->diffForHumans() }} </u>
                            </td>
                            <td> 
          <a class="btn bt-xs btn-info" href="{{route('userroles.getlog.specific', ['id' => $activity->id])}}"> 
            <i class="fa fa-eye"></i> {{ __('translations.view') }}</a>
        </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>

   {!! $logged_requests->appends(['search_day' => $search_day, 'from_hour' => $from_hour, 'to_hour' => $to_hour])->render() !!} 
</div>

      </div>

    </div>

  </section>

@stop
