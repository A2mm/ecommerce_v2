@extends('owner_dashboard.master')
@section('body')
    <style media="screen">
    .ct-chart .ct-series.ct-series-a .ct-line {
        stroke: ##3C2DEC
    }
    .ct-chart .ct-series.ct-series-a .ct-point {
        stroke: ##3C2DEC
    }
    .ct-chart .ct-series.ct-series-b .ct-line {
        stroke: #3C8DBC
    }
    .ct-chart .ct-series.ct-series-b .ct-point {
        stroke: #3C8DBC
    }
    .tool-red{
      background-color: red;
      height:10px;
    }
    .tool-blue{
      background-color: blue;
      height:10px;
    }
    </style>

    <div class="row text-center">
      <h1>{{__('translations.last_week_reports')}}</h1>
      <hr>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="ct-chart ct-perfect-fourth">
        </div>
      </div>

      <div class="col-md-6">

        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>{{__('translations.day')}}</th>
              <th>{{__('translations.orders')}}</th>
            </tr>
          </thead>
          <tbody>

            @for ($i = 0; $i <= 6; $i++)
              <tr>
                <td>{{$last_week[$i]}}</td>
                <td>{{$last_week_orders[$i]}}</td>
              </tr>
            @endfor
          </tbody>
        </table>
      </div>
    </div>
  @endsection
  @section('scrips')
    @parent
    <script>
    var data = {
      labels: {!!json_encode($last_week)!!},
      series: [
        {!!json_encode($last_week_orders)!!},
        {!!json_encode($last_week_orders)!!}
      ],
      colors:["#333", "#222", "#111", "#000"]
    };
    var options = {
      axisY: {
        onlyInteger: true
      },
      plugins: [
      ]
    };
    new Chartist.Line('.ct-chart', data,options);
    </script>
  @show
