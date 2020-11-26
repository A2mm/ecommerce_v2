<table class="table table-bordered table-striped" id="subcategories">
  <thead>
    <tr>
      <th>{{__('translations.name')}}</th>
      <th>{{__('translations.email')}}</th>
      <th>{{__('translations.store')}}</th>
    </tr>
  </thead>
  <tbody>
    @foreach($sellers as $seller)
      <tr>
        <td>{{$seller->name}}</td>
        <td>{{$seller->email}}</td>
        <td>{{$seller->store->name}}</td>
      </tr>
    @endforeach
  </tbody>
</table>
