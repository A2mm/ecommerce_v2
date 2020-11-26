@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
      {{trans('layout.Edit Product')}}
    </h1>
  </section>

   <section class="content">
     <form action="{!! route('manage.products.deleteQuantity.post',['id' => $product->id]) !!}" method="post" id="form">
       <input type="hidden" name="quantity" value="{{ $quantity }}">
       <input type="hidden" name="store_id" value="{{ $store_id }}">
     </form>
  </section>
@stop
@section('scripts')
  <script>
    $(document).ready($function(){
      $('#form').submit();
    });
  </script>
@endsection
