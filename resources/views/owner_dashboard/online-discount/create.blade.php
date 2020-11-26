@extends('owner_dashboard.master')

@section('body')


<section class="content-header">

  <h1>

    اضافة خصم للمنتج   ( {{ $product->name }} )

  </h1>

</section>

<!-- Main content -->

     <?php $user = Auth::user(); ?>

<section class="content">

  <div class="row">

    <div class="col-xs-12">

      <div class="box box-primary">

        <div class="table">
          <div class="d-flex" style="margin:10px;">
            <h4 style="display:inline">سعر المنتج</h4>
            <p style="display:inline; margin-right:10px;">({{$product->productPrices()}}) جنيه</p>
          </div>
          @if ($product->productPrices() != $priceDiscount)
            <div class="d-flex" style="margin:10px;">
              <h4 style="display:inline">السعر بعد الخصم</h4>
              <p style="display:inline; margin-right:10px;">({{$priceDiscount}}) جنيه</p>
            </div>
          @endif

        </div>

        <!-- form start -->
        <form  action="{{route('online.discount.store' , $product->id)}}" method="post">
          {{csrf_field()}}


        <div class="box-body">

          <div class="form-group">

            <label for="discount">*السعر بعد الخصم</label>

            <input class="form-control" id="discount" type="number" name="discount" value="{{old('discount')}}" step="any" />

          </div>



        </div><!-- /.box-body -->

        <div class="box-footer">

          <button type="submit" class="btn btn-primary">{{__('translations.submit')}}</button>


        @if($user->can('delete discount') || $user->can('Administer'))
          @if ($product->productPrices() != $priceDiscount)
            <a href="{{ route('online.discount.destroy' , $product->id) }}"  class="btn btn-success">حذف الخصم</a>
          @endif
        @endif



        </div>
      </form>

      </div>

    </div>

  </div>

</section>

@stop
