



  <!-- Main content -->


    <div class="row">

      <div class="col-xs-12">

        <div class="box">

    <div class="box-header">

      <h3 class="box-title"></h3>

    </div><!-- /.box-header -->
    <!-- quantities in store -->
    @foreach($stores as $store)
    <h3>{{$store->name}}</h3>

    <table class="table">
    <thead>
      <tr>
        <th scope="col">{{__('translations.product_name')}}</th>
        <th scope="col">{{__('translations.quantity')}}</th>
      </tr>
    </thead>
    <tbody>

        @foreach($products as $product)
        <tr>
          <th scope="row">{{$product->name}}</th>
        <td> {{$store->quantity_in_store($product->id)}}</td>
      </tr>


        @endforeach


    </tbody>
  </table>
  @endforeach
<!-- all quantities -->
</div>
  <h3 class="text-center">{{__('translations.total_quantities_in_stores')}}</h3>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">{{__('translations.product_name')}}</th>
      <th scope="col">{{__('translations.quantities')}}</th>
    </tr>
  </thead>
  <tbody>

      @foreach($products as $product)
      <tr>
        <th scope="row">{{$product->name}}</th>
      <td> {{$product->quantity_in_stores()}}</td>
    </tr>
      @endforeach

  </tbody>
</table>

      </div>

    </div>
