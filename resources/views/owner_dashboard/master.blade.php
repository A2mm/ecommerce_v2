@include('owner_dashboard.header')
@yield('styles')
@section('sidebar')
  @include('owner_dashboard.sidebar')
@show
<div class="content-wrapper">
@include('errors')
@include('message')
@yield('body')
</div>
@include('owner_dashboard.footer')
@section('scrips')
  @include('owner_dashboard.scripts')
@show
@yield('scripts')
</body>
</html>
