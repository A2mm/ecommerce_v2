@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">

    <h1>

      {{__('translations.owners')}}

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

    <table class="table table-bordered table-striped" id="vendors">

      <thead>

        <tr>

          <th>{{__('translations.owner_name')}}</th>

          <th>{{__('translations.email')}}</th>

          <th>{{__('translations.role')}}</th>

          <th>{{__('translations.created_at')}}</th>

          <th>{{__('translations.Actions')}}</th>

        </tr>

      </thead>

      <tbody>
      @foreach($owners as $owner)
      <tr>
        <td>{{$owner->name}}</td>
        <td>{{$owner->email}}</td>
        <td>{{$owner->role}}</td>
        <td>{{$owner->created_at}}</td>
        <td>
        <a href="{{route('manage.owners.edit', ['id' => $owner->id])}}" class="btn btn-xs btn-primary">{{__('translations.view')}} & {{__('translations.edit')}}</a>

        <a data-href="{{route('manage.owners.delete', ['id' => $owner->id])}}" class="delete btn btn-xs btn-danger">{{__('translations.delete')}}</a>
        {{-- <a href="{{route('manage.owners.view', ['id' => $owner->id])}}"class="btn btn-xs btn-info">Show Details</a> --}}
        </td>
      </tr>
    @endforeach
      </tbody>

    </table>

</div>

      </div>

    </div>

  </section>





  @section('scrips')

    @parent

    <script type="text/javascript">

      $('#vendors').DataTable();

    </script>

  @show

@stop
