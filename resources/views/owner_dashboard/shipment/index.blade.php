@extends('owner_dashboard.master')
@section('body')

<section class="content-header">
  <h1>
    {{trans('الشحن')}}
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
<section class="content">
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div><!-- /.box-header -->

            <?php $user = Auth::user(); ?>

            <div class="row">
              <div class="col-md-9">
                @if($user->can('shipment create') || $user->can('Administer'))
                  <a style="margin-right: 10px;" class="btn btn-success" href="{{ route('shipment.create') }}">
                    اضافة <i class="fa fa-plus" aria-hidden="true"></i> </a>
                @endif
              </div>
            </div>
            <br>
          </div>
        </div>
        <div id="dynamic_content">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="text-align: right;"> {{ 'المنطقة' }} </th>
                <th style="text-align: right;">{{ 'السعر' }}</th>
                <th style="text-align: right;">{{__('translations.actions')}}</th>
              </tr>
            </thead>
            <tbody id="table_body">
              @foreach($shipments as $shipment)
                <tr>
                  <td>{{ $shipment->area}}</td>
                  <td>{{ $shipment->price }}</td>
                  <td>
                    @if($user->can('shipment edit') || $user->can('Administer'))
                      <a href="{{route('shipment.edit' , $shipment->id)}}" class="btn btn-primary">تعديل <i class="fa fa-edit" aria-hidden="true"></i></a>
                    @endif
                    @if($user->can('shipment destroy') || $user->can('Administer'))
                      <form method="POST" action="{{ route('shipment.destroy' , $shipment->id) }}" accept-charset="UTF-8" style="display:inline">
                          {{ method_field('DELETE') }}
                          {{ csrf_field() }}
                          <button type="submit" class="btn btn-danger " onclick="return confirm(&quot;{{ 'تأكيد الحذف' }}&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> {{ 'حذف' }}</button>
                      </form>
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

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

@stop
