@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
    {{__('translations.add_owner')}}
    </h1>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
                  <!-- form start -->
                  {!! Form::open(['route' => 'manage.owner.store']) !!}
                   <div class="box-body">
                      <div class="form-group">
                        <label for="name">{{__('translations.name')}}</label>
                        <input class="form-control" id="name" type="text" name="name">
                      </div>
                      <div class="form-group">
                        <label for="email">{{__('translations.email')}}</label>
                        <input class="form-control" id="email" name="email" type="email">
                      </div>
                      <div class="form-group">
                        <label for="password">{{__('translations.password')}}</label>
                        <input class="form-control" id="password" name="password" type="password">
                      </div>

                      <h3>{{__('translations.permisions')}}</h3>
                      <div class="checkbox">
<label><input type="checkbox" value="general" name="perv[]">{{__('translations.general_owner')}}</label> <br>

</br><h4>{{__('translations.market')}}</h4>
                        <label><input type="checkbox" value="subcategories" name="perv[]">{{__('translations.sections_control')}}</label><br>
                        <label><input type="checkbox" value="products" name="perv[]">{{__('translations.products_control')}}</label><br>
                        <label><input type="checkbox" value="orders" name="perv[]">{{__('translations.orders_control')}}</label><br>
                        <label><input type="checkbox" value="coupons" name="perv[]">{{__('translations.copouns_control')}}</label><br>
                        <label><input type="checkbox" value="entire_shop" name="perv[]">{{__('translations.all_the_market')}}</label><br>
                        <br>

                      </br><label><h4>{{__('translations.customers')}}</h4>
                        <input type="checkbox" value="customer" name="perv[]">{{__('translations.customers_control')}}<br>
                        </label> <br>

                      </br><label><h4>{{__('translations.promoters')}}</h4>
                        <input type="checkbox" value="affiliate" name="perv[]">{{__('translations.promoters_control')}}<br>
                        </label> <br>

                      </br><label><h4>{{__('translations.promotion_program')}}</h4>
                        <input type="checkbox" value="link" name="perv[]">{{__('translations.promotion_program_control')}}<br>
                        </label> <br>

                      </br><label><h4>{{__('translations.partners')}}</h4>
                        <input type="checkbox" value="vendor" name="perv[]">{{__('translations.partners_control')}}<br>
                        </label> <br>

                      </br><label><h4>{{__('translations.moderators')}}</h4>
                        <input type="checkbox" value="admin" name="perv[]">{{__('translations.moderators_control')}}<br>
                        </label> <br>

                      </br><label><h4>{{__('translations.quantities')}}</h4>
                        <input type="checkbox" value="quantity" name="perv[]">{{__('translations.quantities_control')}}<br>
                        </label> <br>

                      </br><label><h4>{{__('translations.owners')}}</h4>
                        <input type="checkbox" value="owner" name="perv[]">{{__('translations.owners_control')}}<br>
                        </label> <br>

                      </br><label><h4>{{__('translations.video')}}</h4>
                        <input type="checkbox" value="video" name="perv[]">{{__('translations.video_control')}}<br>
                        </label> <br>

                      </br><label><h4>{{__('translations.csv')}}</h4>
                        <input type="checkbox" value="csv" name="perv[]">{{__('translations.csv')}}<br>
                        </label> <br>

                      </div>
                      </div>
                      <div class="box-footer">
                      <button type="submit" class="btn btn-primary">{{__('translations.submit')}}</button>
                    </div>
                  {!! Form::close() !!}

      </div>

    </div>
    </div>
    </section>
@stop
