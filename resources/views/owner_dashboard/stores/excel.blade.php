<table class="table table-bordered table-striped" id="stores">
  <thead>
    <tr>
      <th style="text-align: right;">{{__('translations.name')}}</th>
      <th style="text-align: right;">{{__('translations.address')}}</th>
    </tr>
  </thead>
  <tbody>
    @foreach($stores as $store)
      <tr>
        <td>{{$store->name}}</td>
        <td>{{$store->address}}</td>
      </tr>
    @endforeach
  </tbody>
</table>
