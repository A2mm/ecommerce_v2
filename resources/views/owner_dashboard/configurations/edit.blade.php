@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
      {{__('translations.set_configuration')}}
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
                  <!-- form start -->
                  {!! Form::model($configurations, ['route' => ['manage.configuration.edit.post'], 'files' => true]) !!}
                    <div class="box-body">
                      @foreach($configurations as $configuration)
                        @if( $configuration->input_type == 'text' )
                          <div class="form-group">
                            <label for="name">{{ $configuration->name }}</label>
                            <input class="form-control" required id="id" type="hidden" name="configurations[{{$loop->index}}][id]" value="{{$configuration->id}}">
                            <input class="form-control" required id="value" type="text" name="configurations[{{$loop->index}}][value]" value="{{$configuration->value}}">
                          </div>
                        @elseif( $configuration->input_type == 'number' )
                          <div class="form-group">
                            <label for="name">{{ $configuration->name }}</label>
                            <input class="form-control" required id="id" type="hidden" name="configurations[{{$loop->index}}][id]" value="{{$configuration->id}}">
                            <input class="form-control" required id="value" type="number" name="configurations[{{$loop->index}}][value]" value="{{$configuration->value}}" min="0">
                          </div>
                        @elseif( $configuration->input_type == 'select' )
                          <div class="form-group">
                            <label for="name">{{ $configuration->name }}</label>
                            <input class="form-control" required id="id" type="hidden" name="configurations[{{$loop->index}}][id]" value="{{$configuration->id}}">
                            @php
                                if($configuration->name == 'main_country'){
                                  $list = $select_data['countries'];
                                } elseif($configuration->name == 'main_currency'){
                                  $list = $select_data['currencies'];
                                }
                            @endphp
                            {!!Form::select( 'configurations['.$loop->index.'][value]', $list, $configuration->value, ['class' => 'form-control select2'])!!}
                          </div>
                        @endif
                      @endforeach
                    </div><!-- /.box-body -->
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">{{__('translations.submit')}}</button>
                    </div>
                  {!! Form::close() !!}
                </div>
      </div>
    </div>
  </section>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
  <script>
    $(document).ready(function() {
      $('.select2').select2();
    });
  </script>
@stop
