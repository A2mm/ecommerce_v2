
  <table class="table table-bordered table-striped">

    <thead>

      <tr>
         <th style="text-align: right;">{{__('translations.product_item')}}</th>
         <th style="text-align: right;">{{__('translations.unique_id')}}</th>
         <th style="text-align: right;">{{__('translations.quantity')}}</th>
      </tr>

    </thead>

    <tbody>
      @foreach($products as $product)
      <tr>
       <td>{{$product->name}}</td>
        <td>{{$product->unique_id}}</td>
       <td>{{$store->quantity_in_store($product->id)}}</td>

     </tr>
      @endforeach

    </tbody>

