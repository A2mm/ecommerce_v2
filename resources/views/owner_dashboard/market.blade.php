@extends('owner_dashboard.master')
@section('body')
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">{{__('translations.categories_table')}}</h4>
                    {{-- <p class="category">Here is a subtitle for this table</p> --}}
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                        	<th>{{__('translations.name')}}</th>
                          <th>{{__('translations.arabic_name')}}</th>
                        	<th>{{__('translations.description')}}</th>
                          <th>{{__('translations.arabic_description')}}</th>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                            <tr>
                            	<td>{{$category->name}}</td>
                            	<td>{{$category->arabic_name}}</td>
                            	<td>{{$category->description}}</td>
                            	<td>{{$category->arabic_description}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
      <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">{{__('translations.subcategories_table')}}</h4>
                    {{-- <p class="category">Here is a subtitle for this table</p> --}}
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                        	<th>{{__('translations.name')}}</th>
                          <th>{{__('translations.arabic_name')}}</th>
                        	<th>{{__('translations.description')}}</th>
                          <th>{{__('translations.arabic_description')}}</th>
                          <th>{{__('translations.category_name')}}</th>
                        </thead>
                        <tbody>
                        @foreach ($subcategories as $subcategory)
                            <tr>
                            	<td>{{$subcategory->name}}</td>
                            	<td>{{$subcategory->arabic_name}}</td>
                            	<td>{{$subcategory->description}}</td>
                            	<td>{{$subcategory->arabic_description}}</td>
                              <td>{{$subcategory->category->name}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
      <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">{{__('translations.categories_table')}}</h4>
                    {{-- <p class="category">Here is a subtitle for this table</p> --}}
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                        	<th>{{__('translations.name')}}</th>
                          <th>{{__('translations.arabic_name')}}</th>
                        	<th>{{__('translations.description')}}</th>
                          <th>{{__('translations.arabic_description')}}</th>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                            <tr>
                            	<td>{{$category->name}}</td>
                            	<td>{{$category->arabic_name}}</td>
                            	<td>{{$category->description}}</td>
                            	<td>{{$category->arabic_description}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
      <div class="col-md-12">
            <div class="card">
                <div class="header">
                    <h4 class="title">{{__('translations.categories_table')}}</h4>
                    {{-- <p class="category">Here is a subtitle for this table</p> --}}
                </div>
                <div class="content table-responsive table-full-width">
                    <table class="table table-striped">
                        <thead>
                        	<th>{{__('translations.name')}}</th>
                          <th>{{__('translations.arabic_name')}}</th>
                        	<th>{{__('translations.description')}}</th>
                          <th>{{__('translations.arabic_description')}}</th>
                        </thead>
                        <tbody>
                        @foreach ($categories as $category)
                            <tr>
                            	<td>{{$category->name}}</td>
                            	<td>{{$category->arabic_name}}</td>
                            	<td>{{$category->description}}</td>
                            	<td>{{$category->arabic_description}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
  </div>
@endsection
