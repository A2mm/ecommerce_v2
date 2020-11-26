<table class="table table-bordered table-striped" style="text-align: center;">
  <thead>
    <tr class="success">
      <th style="text-align: center;">{{ __('translations.user_name') }}</th>
      <th style="text-align: center;">{{ __('translations.user_phone') }}</th>
      <th style="text-align: center;">{{ __('translations.usertype') }}</th>
      <th style="text-align: center;">{{ __('translations.total')}} </th>
    </tr>
  </thead>
  <tbody>
    @foreach($users as $user)
      <tr>
        <td> {{ $user['user_name'] }}</td>
        <td>{{ $user['user_phone'] }}</td>
        <td> {{ $user['usertype'] }} </td>
        <td> {{ round($user['total'], 10) }} {{ __('translations.egp') }} </td>
      </tr>
    @endforeach
  </tbody>
</table>
