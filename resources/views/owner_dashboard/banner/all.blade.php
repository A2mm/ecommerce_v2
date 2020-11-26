@extends('owner_dashboard.master')


    <!-- DataTables -->

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>


@section('body')

     <?php $user = Auth::user(); ?>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
    <div class="box-header">

 @if($user->can('create banner') || $user->can('Administer'))
      <a href="{{ route('manage.banner.create')}}" ><button class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> {{__('translations.add_new_banner')}} </button></a>
 @endif


      <h3 class="box-title"></h3>
    </div><!-- /.box-header -->
  <table class="table table-bordered table-striped" style="font-size: 14px;">

    <thead>
      <tr>
        <th>{{__('translations.title')}}</th>
        <th>{{__('translations.banner_type')}}</th>
        <th>{{__('translations.actions')}}</th>
      </tr>
    </thead>
    <tbody>
      @foreach($banners as $banner)
      <tr>


      <td>{{ $banner->title }}</td>
      <td>{{ $banner->btype_name() }}</td>

      <td>

         @if($user->can('edit banner') || $user->can('Administer'))
        <a href="{{ route('manage.banner.edit',['id' => $banner->id])}}" ><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> {{__('translations.edit')}}</button></a>
         @endif
      
       @if($user->can('view banner details') || $user->can('Administer')) 
        <a href="{{ route('manage.banner.show',['id' => $banner->id])}}" ><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> {{__('translations.show')}}</button></a>
         @endif

         @if($user->can('delete banner') || $user->can('Administer'))

         <a data-href="{{ route('manage.banner.delete',['id' => $banner->id])}}" href="{{ route('manage.banner.delete',['id' => $banner->id])}}" class="delete btn btn-danger btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> {{__('translations.delete')}}</button></a>


       <?php /* <form  action="{{route('manage.banner.delete',['id' => $banner->id])}}" method="post" class="form-group" id="delete_form">
          <button type="button" name="button" class="btn btn-danger btn-xs delete-btn"><i class="fa fa-trash" aria-hidden="true"></i> {{__('translations.delete')}}</button>
        </form>*/ ?>
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

  @section('scrips')
    @parent

  <script>
    $(document).ready(function() {
      $(".delete-btn").on('click',function(){
        if (confirm('Confirm Delete!')) {
          $("#delete_form").submit();
        }
      });
      $('#example').DataTable({
          "order":[[0,'desc']]
      });
    });
  </script>

  @show
@stop
