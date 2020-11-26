@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>{{__('translations.products_codes')}}</h1>
  </section>
  <section class="content">
    @if (!$codes->isEmpty())
      <table class="datatable table">
        <thead>
          <th>{{__('translations.code')}}</th>
          <th>{{__('translations.store')}}</th>
          <th></th>
          <th></th>
        </thead>
        <tbody>
        <?php $x = 1;?>
          @foreach ($codes as $code)
            <tr>
              <td>{{ $code->code }}</td>
              <td>{{$code->store->name}}</td>
              <td id="bar<?php echo $x?>">   <p> {!! DNS1D::getBarcodeSVG($code->code, 'C128') !!}</p>
              <script>
              var counter = '<?php echo $x?>' ;
              </script>

<?php $x++;?>
</td>
<td><a style="cursor: pointer;" onclick="print(counter)" >{{__('translations.print')}}</a></td>

            </tr>

          @endforeach
        </tbody>
      </table>
    @endif
    <script>
function print(counter) {

    var divToPrint=document.getElementById('bar'+counter+'');
    var newWin=window.open('','Print-Window');
    newWin.document.open();
    newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
    newWin.document.close();
    setTimeout(function(){newWin.close();},1);

}

</script>

  </section>

@endsection
