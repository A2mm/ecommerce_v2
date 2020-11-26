@extends('owner_dashboard.master')

@section('body')

  <section class="content-header">

    <h1>

     <?php echo __('translations.all_sellers'); ?>

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

  <table class="table table-bordered table-striped" id="subcategories">

    <thead>

      <tr>

        <th><?php echo __('translations.name'); ?></th>

        <th><?php echo __('translations.email'); ?></th>

        <th><?php echo __('translations.store'); ?></th>

        <th><?php echo __('translations.actions'); ?></th>

      </tr>

    </thead>

    <tbody>
    @foreach($sellers as $seller)
            <tr>
              <td>{{$seller->name}}</td>
              <td>{{$seller->email}}</td>
              <td>{{$seller->store->name}}</td>
              <td>
              <a href="{{route('manage.sellers.view',['id' => $seller->id])}}" class="btn btn-xs btn-primary"><?php echo __('translations.view'); ?></a>
              <a href="{{route('manage.sellers.edit',['id' => $seller->id])}}" class="btn btn-xs btn-primary"><?php echo __('translations.edit'); ?></a>
              <a href="{{route('manage.sellers.suspend',['id' => $seller->id])}}" class="btn btn-xs btn-danger">
              @if($seller->suspend==1)
              <?php echo __('translations.active'); ?>
              @else
              <?php echo __('translations.suspend'); ?>
              @endif
              </a>
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
