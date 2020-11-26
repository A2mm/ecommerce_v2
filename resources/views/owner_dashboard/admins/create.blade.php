@extends('owner_dashboard.master')
@section('body')
  <section class="content-header">
    <h1>
    {{ __('translations.add_moderator') }}
    </h1>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box box-primary">
                  <!-- form start -->
                  {!! Form::open(['route' => 'manage.admins.store']) !!}
                    <div class="box-body">
                      <div class="form-group">
                        <label for="name">{{ __('translations.name') }}</label>
                        <input class="form-control" id="name" type="text" name="name">
                      </div>
                      <div class="form-group">
                        <label for="email">{{ __('translations.email') }}</label>
                        <input class="form-control" id="email" name="email" type="email">
                      </div>
                      <div class="form-group">
                        <label for="password">{{ __('translations.password') }}</label>
                        <input class="form-control" id="password" name="password" type="password">
                      </div>
                      <label for="">{{ __('translations.permisions') }}</label>
                      <div class="checkbox">
                        <label><input type="checkbox" value="1" name="chat_prv">{{ __('translations.chat_service') }}</label> <br>
                        <label><input type="checkbox" value="1" name="notification_prv">{{ __('translations.send_notification') }}</label> <br>
                        <label><input type="checkbox" value="1" name="email_prv">{{ __('translations.send_email') }}</label> <br>
                        <label><input type="checkbox" value="1" name="aff_prv">{{ __('translations.manage_affiliates') }}</label> <br>
                        <label><input type="checkbox" value="1" name="cus_prv">{{ __('translations.manage_customers') }}</label> <br>
                        <label><input type="checkbox" value="1" name="ven_prv">{{ __('translations.manage_vendors') }}</label>
                      </div>

                    </div><!-- /.box-body -->
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">{{ __('translations.submit') }}</button>
                    </div>
                  {!! Form::close() !!}
                </div>
      </div>
    </div>
  </section>
@stop
