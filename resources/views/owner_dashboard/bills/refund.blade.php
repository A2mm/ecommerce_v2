@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>{{__('translations.refund_item')}}</h1>
  </section>
  <section class="content">
    <form class="col-md-10" action="{!! route('manage.purchase.refund') !!}" method="post">
      {{csrf_field()}}
      <div class="form-group">
        <label class="col-md-12">{{__('translations.unique_id')}}</label>
        <input type="number" name="unique_id" value="{{old('unique_id')}}" class="form-control">
      </div>
      <div class="form-group">
        <label class="col-md-12">{{__('translations.refund_to_store')}}</label>
        <select class="form-control select2" name="store_id">
          <option disabled selected>{{__('translations.choose_store')}}</option>
          @foreach ($stores as $store)
            <option value="{{ $store->id }}">{{ $store->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="text-center row">
        <button type="submit" class="btn btn-primary">{{__('translations.submit')}}</button>
      </div>
    </form>
  </section>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
  <script>
    $(document).ready(function(){
      $('.select2').select2();
    });
  </script>
@endsection
