<table class="table table-bordered table-striped" style="text-align: center;">
  <thead>
    <tr class="success">
      <th style="text-align: center;">{{__('translations.store_getname')}}</th>
      <th style="text-align: center;">{{__('translations.store_totalprice')}}</th>
    </tr>
  </thead>
  <tbody>
    @foreach($unique_stores as $store)
      <tr>
        <td> {{ $store['store_name'] }}</td>
        <td> {{ $store['store_price'] }} {{ __('translations.egp') }}</td>
      </tr>
    @endforeach
  </tbody>
</table>
