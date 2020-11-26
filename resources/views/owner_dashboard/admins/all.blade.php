@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
     {{ __('translations.all_moderators') }}
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
  <table class="table table-bordered table-striped" id="admins">
    <thead>
      <tr>
        <th>{{ __('translations.name') }}</th>
        <th>{{ __('translations.email') }}</th>
        <th>{{ __('translations.created_at') }}</th>
        <th>{{ __('translations.actions') }}</th>
      </tr>
    </thead>
    <tbody>
    </tbody>
  </table>
</div>
      </div>
    </div>
  </section>

  @section('scrips')
    @parent
    <script type="text/javascript">
      $('#admins').DataTable( {
          processing: true,
          serverSide: true,
          ajax: "{{route('manage.admins.all.data')}}",
          columns: [
          { data: 'name', name: 'name' },
          { data: 'email', name: 'email' },
          { data: 'created_at', name: 'created_at' },
          { data: 'action', name: 'action', orderable: false, searchable: false}
          ]
      });
    </script>

  @show
@stop
