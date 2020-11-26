<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th style="text-align: right;">{{__('translations.name')}}</th>
      <th style="text-align: right;">{{__('translations.phone')}}</th>
      <th style="text-align: right;">{{__('translations.user_type')}}</th>
      <th style="text-align: right;">{{__('translations.created_at')}}</th>
    </tr>
  </thead>
  <tbody>
    @foreach($customers as $customer)
      <tr>
        <td>{{$customer->name}}</td>
        <td>{{$customer->phone}}</td>
        <td>{{$customer->usertype->name ?? 'user' }}</td>
        <td>{{$customer->created_at}}</td>
      </tr>
    @endforeach
  </tbody>
</table>
