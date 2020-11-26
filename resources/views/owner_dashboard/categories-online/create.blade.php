@extends('owner_dashboard.master')

@section('body')


<section class="content-header">

  <h1>

  اضافة فئة اونلاين

  </h1>

</section>

<!-- Main content -->

     <?php $user = Auth::user(); ?>

<section class="content">

  <div class="row">

    <div class="col-xs-12">

      <div class="box box-primary">
        <!-- form start -->
        <form  action="{{route('categories.online.store')}}" method="post">
          {{csrf_field()}}


        <div class="box-body">

          <div class="form-group">

            <label for="name">*الاسم</label>

            <input class="form-control" id="name" type="text" name="name" value="{{old('name')}}">

          </div>


          <div class="form-group{{$errors->has('description') ? 'error' : null}}">
                        <label> * {{ __('translations.description')}}</label>
  <textarea id="mycontent" rows="5" name="description" class="form-control" id="description">{{old('description')}}</textarea>
                        @if($errors->has('description'))
                        <span class="help-block" style="color:red;">{{$errors->first('description')}}</span>
                        @endif
</div>



        </div><!-- /.box-body -->

        <div class="box-footer">

          <button type="submit" class="btn btn-primary">{{__('translations.submit')}}</button>

        </div>
      </form>

      </div>

    </div>

  </div>

</section>

@stop
