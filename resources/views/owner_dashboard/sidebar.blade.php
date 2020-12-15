<header class="main-header">
  <a href="{{route('owner.dashboard')}}" class="logo" style="background: rgb(35, 60, 60);">
    <span class="logo-lg"><b>{{__('translations.owner_dashboard')}}</b></span>
  </a>
  <nav style="background: rgb(35, 71, 71);" class="navbar navbar-static-top" role="navigation">
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">{{__('translations.toggle_navigation')}}</span>
    </a>
    <?php // ?>
       <div class="dropdown pull-left" style="padding: 13px;">
<a style="color: white;" href="#" class="dropdown-toggle" type="button" id="about-us" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<b> {{ strtoupper(Auth::user()->name) }} </b>
<span class="caret"></span>
</a>
<ul class="dropdown-menu actionsmenu" aria-labelledby="about-us" style="background: black;">
<li><a href="{{route('owner.logout')}}"><i class="fa fa-sign-out"></i>{{__('translations.logout')}}</a></li>
</ul>
</div>
    <?php // ?>
  </nav>
</header>
<aside class="main-sidebar" style="background: rgb(24, 48, 48);">
  <section class="sidebar">
    <div class="user-panel">
      <div class="pull-left image">
      </div>
      <div class="pull-left info">
      </div>
    </div>
  </style>

    <?php $logged_user = Auth::user(); ?>
    <ul class="sidebar-menu">

      <!--SHOP-->
      <li
        class="treeview {{(Route::current()->getName() == 'manage.subcategory.all' || Route::current()->getName() == 'manage.subcategory.create' || Route::current()->getName() == 'manage.products.all' || Route::current()->getName() == 'manage.products.create' || Route::current()->getName() == 'manage.orders.all' || Route::current()->getName() ==  'manage.purchase.all' || Route::current()->getName() == 'manage.products.all.archive' || Route::current()->getName() == 'manage.category.all' || Route::current()->getName() == 'manage.category.create' || Route::current()->getName() == 'manage.products.refunds' || Route::current()->getName() == 'manage.products.onlinerefunds' || Route::current()->getName() == 'manage.products.view.product.prices' || Route::current()->getName() == 'manage.wholesale.customers.purchases' || Route::current()->getName() == 'shipment.index' || Route::current()->getName() == 'coupon.index' ||  Route::current()->getName() == 'coupon.create' || Route::current()->getName() == 'cancelled.purchases' || Route::current()->getName() == 'online.discount' || Route::current()->getName() == 'categories.online.create' || Route::current()->getName() == 'categories.online' || Route::current()->getName() == 'pending.purchases' || Route::current()->getName() == 'in_progress.purchases' || Route::current()->getName() == 'delieverd.purchases' || Route::current()->getName()=='manage.purchase.all.delivered') ? 'active' : '' }}">

        <a href="#">
          <i class="fa fa-dashboard"></i> <span>{{__('translations.manage_products')}}</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
       
       @if($logged_user->can('view all subcategories') || $logged_user->can('Administer'))
      <li class="{{(Route::current()->getName() == 'manage.subcategory.all') ? 'active' : ''}}"><a href="{{route('manage.subcategory.all')}}"><i class="fa fa-circle-o"></i>{{__('translations.all_subcategories')}}</a></li>
       @endif

     <?php // @canany(['create subcategory', 'Administer']) ?>
     @if($logged_user->can('create subcategory') || $logged_user->can('Administer'))
      <li class="{{(Route::current()->getName() == 'manage.subcategory.create') ? 'active' : ''}}"><a href="{{route('manage.subcategory.create')}}"><i class="fa fa-circle-o"></i>{{__('translations.add_subcategory')}}</a></li>
      @endif
    
      @if($logged_user->can('view all categories') || $logged_user->can('Administer'))
      <li class="{{(Route::current()->getName() == 'manage.category.all') ? 'active' : ''}}"><a href="{{route('manage.category.all')}}"><i class="fa fa-circle-o"></i>{{__('translations.all_categories')}}</a></li>
      @endif

       @if($logged_user->can('create category') || $logged_user->can('Administer'))
      <li class="{{(Route::current()->getName() == 'manage.category.create') ? 'active' : ''}}"><a href="{{route('manage.category.create')}}"><i class="fa fa-circle-o"></i>{{__('translations.add_category')}}</a></li>
      @endif

      @if($logged_user->can('categories online') || $logged_user->can('Administer'))
      <li class="{{(Route::current()->getName() == 'categories.online') ? 'active' : ''}}"><a href="{{route('categories.online')}}"><i class="fa fa-circle-o"></i>{{'كل الفئات الاونلاين'}}</a></li>
      @endif

      @if($logged_user->can('categories online create') || $logged_user->can('Administer'))
      <li class="{{(Route::current()->getName() == 'categories.online.create') ? 'active' : ''}}"><a href="{{route('categories.online.create')}}"><i class="fa fa-circle-o"></i>{{' اضافة فئة اونلاين'}}</a></li>
      @endif

       @if($logged_user->can('view all products') || $logged_user->can('Administer'))
      <li class="{{(Route::current()->getName() == 'manage.products.all') ? 'active' : ''}}"><a href="{{route('manage.products.all')}}"><i class="fa fa-circle-o"></i>{{__('translations.all_products')}}</a></li>
      @endif

      @if($logged_user->can('view archived products') || $logged_user->can('Administer'))
      <li class="{{(Route::current()->getName() == 'manage.products.all.archive') ? 'active' : ''}}"><a href="{{route('manage.products.all.archive')}}"><i class="fa fa-circle-o"></i>{{__('translations.archived_products')}}</a></li>
      @endif

      @if($logged_user->can('add product') || $logged_user->can('Administer'))
      <li class="{{(Route::current()->getName() == 'manage.products.create') ? 'active' : ''}}"><a href="{{route('manage.products.create')}}"><i class="fa fa-circle-o"></i>{{__('translations.add_product')}}</a></li>
      @endif

       @if($logged_user->can('view transactions') || $logged_user->can('Administer'))
      <li class="{{(Route::current()->getName() == 'manage.purchase.all.delivered') ? 'active' :''}}">
        <a href="{{route('manage.purchase.all.delivered')}}">
          <i class="fa fa-circle-o"></i>
        {{__('translations.delivered_transactions')}}
      </a>
      </li>
    @endif
    @if($logged_user->can('pending purchases') || $logged_user->can('Administer'))
      {{-- pending transactions --}}
      <li class="{{(Route::current()->getName() == 'pending.purchases') ? 'active' :''}}">

        <a href="{{route('pending.purchases')}}">
          <i class="fa fa-circle-o"></i>
          {{'المعاملات المعلقة'}}
        </a>
      </li>
    @endif
    @if($logged_user->can('in_progress purchases') || $logged_user->can('Administer'))
      {{-- in progress transactions --}}
      <li class="{{(Route::current()->getName() == 'in_progress.purchases') ? 'active' :''}}">

        <a href="{{route('in_progress.purchases')}}">
          <i class="fa fa-circle-o"></i>
          {{'المعاملات الجارية'}}
        </a>
      </li>
    @endif
    @if($logged_user->can('delieverd purchases') || $logged_user->can('Administer'))
      {{-- delivered transactions --}}
      <li class="{{(Route::current()->getName() == 'delieverd.purchases') ? 'active' :''}}">

        <a href="{{route('delieverd.purchases')}}">
          <i class="fa fa-circle-o"></i>
          {{'المعاملات المسلمة'}}
        </a>
      </li>
    @endif
    @if($logged_user->can('cancelled purchases') || $logged_user->can('Administer'))
      {{-- cancelled transactions --}}
      <li class="{{(Route::current()->getName() == 'cancelled.purchases') ? 'active' :''}}">

        <a href="{{route('cancelled.purchases')}}">
          <i class="fa fa-circle-o"></i>
          {{'المعاملات الملغاة'}}
        </a>
      </li>
    @endif
    {{-- @if($logged_user->can('online discount') || $logged_user->can('Administer'))
      Online discount products
      <li class="{{(Route::current()->getName() == 'online.discount') ? 'active' :''}}">

        <a href="{{route('online.discount')}}">
          <i class="fa fa-circle-o"></i>
          {{'خصم اونلاين'}}
        </a>
      </li>
    @endif --}}
    @if($logged_user->can('index coupon') || $logged_user->can('Administer'))
      {{-- all promotion codes --}}
      <li class="{{(Route::current()->getName() == 'coupon.index') ? 'active' :''}}">

        <a href="{{route('coupon.index')}}">
          <i class="fa fa-circle-o"></i>
          {{'أكواد الخصم'}}
        </a>
      </li>
    @endif
    @if($logged_user->can('create coupon') || $logged_user->can('Administer'))
      {{-- add promotion code --}}
      <li class="{{(Route::current()->getName() == 'coupon.create') ? 'active' :''}}">

        <a href="{{route('coupon.create')}}">
          <i class="fa fa-circle-o"></i>
          {{'اضافة كود خصم'}}
        </a>
      </li>
    @endif
    @if($logged_user->can('shipments') || $logged_user->can('Administer'))
      {{-- add promotion code --}}
      <li class="{{(Route::current()->getName() == 'shipment.index') ? 'active' :''}}">
        <a href="{{route('shipment.index')}}">
          <i class="fa fa-circle-o"></i>
          {{'الشحن'}}
        </a>
      </li>
    @endif

       @if($logged_user->can('view wholesale purchases report') || $logged_user->can('Administer'))
      <li class="{{(Route::current()->getName() == 'manage.wholesale.customers.purchases') ? 'active' :''}}">
        <a href="{{route('manage.wholesale.customers.purchases')}}">
          <i class="fa fa-circle-o"></i>
        {{__('translations.wholesale_transactions')}}
      </a>
    </li>
     @endif


       @if($logged_user->can('view product prices') || $logged_user->can('Administer'))
      <li class="{{(Route::current()->getName() == 'manage.products.view.product.prices') ? 'active' :''}}">
        <a href="{{route('manage.products.view.product.prices')}}">
          <i class="fa fa-circle-o"></i>
        {{__('translations.product_prices')}}
       </a>
      </li>
@endif
       @if($logged_user->can('view refunds') || $logged_user->can('Administer'))
      <li class="{{(Route::current()->getName() == 'manage.products.refunds') ? 'active' :''}}">
        <a href="{{route('manage.products.refunds')}}">
          <i class="fa fa-circle-o"></i>
        {{__('translations.refunds')}}   
      </a>
      <?php /* @endif */?>
</li>
@endif

@if($logged_user->can('view online refunds') || $logged_user->can('Administer'))
      <li class="{{(Route::current()->getName() == 'manage.products.onlinerefunds') ? 'active' :''}}">
        <a href="{{route('manage.products.onlinerefunds')}}">
          <i class="fa fa-circle-o"></i>
        {{__('translations.onlinerefunds')}}   
      </a>
      <?php /* @endif */?>
</li>
@endif
    </ul>
    </li>

    <!--CUSTOMERS-->
    <li class="treeview {{(Route::current()->getName() == 'manage.customers.all' || Route::current()->getName() == 'manage.customers.create' || Route::current()->getName() == 'manage.allcustomers.report') ? 'active' : '' }}">
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>{{__('translations.clients_managment')}}</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        @if($logged_user->can('view all clients') || $logged_user->can('Administer'))
        <li class="{{(Route::current()->getName() == 'manage.customers.all') ? 'active' : ''}}"><a href="{{route('manage.customers.all')}}"><i class="fa fa-circle-o"></i>{{__('translations.all_clients')}}</a></li>
        @endif

        @if($logged_user->can('create client') || $logged_user->can('Administer'))
         <li class="{{(Route::current()->getName() == 'manage.customers.create') ? 'active' : ''}}"><a href="{{route('manage.customers.create')}}"><i class="fa fa-circle-o"></i>{{__('translations.add_client')}}</a></li>
         @endif

          @if($logged_user->can('view all customers report') || $logged_user->can('Administer'))
         <li class="{{(Route::current()->getName() == 'manage.allcustomers.report') ? 'active' : ''}}"><a href="{{route('manage.allcustomers.report')}}"><i class="fa fa-circle-o"></i>{{__('translations.allcustomers_report')}}</a></li>
         @endif

      </ul>
    </li>
    <!--END CUSTOMERS-->

    <!--Sellers-->
    <li class="treeview {{(Route::current()->getName() == 'manage.sellers.all' || Route::current()->getName() == 'manage.sellers.create' || Route::current()->getName() == 'manage.allsellers.report' || Route::current()->getName() == 'manage.allsellers.kilo.report') ? 'active' : '' }}">

      <a href="#">
        <i class="fa fa-dashboard"></i> <span>{{__('translations.sellers_management')}}</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        @if($logged_user->can('view all sellers') || $logged_user->can('Administer'))
        <li class="{{(Route::current()->getName() == 'manage.sellers.all') ? 'active' : ''}}"><a href="{{route('manage.sellers.all')}}"><i class="fa fa-circle-o"></i>{{__('translations.all_sellers')}}</a></li>
        @endif

        @if($logged_user->can('create seller') || $logged_user->can('Administer'))
        <li class="{{(Route::current()->getName() == 'manage.sellers.create') ? 'active' : ''}}"><a href="{{route('manage.sellers.create')}}"><i class="fa fa-circle-o"></i>{{__('translations.create_seller')}}</a></li>
        @endif

        @if($logged_user->can('view sellers report') || $logged_user->can('Administer'))
        <li class="{{(Route::current()->getName() == 'manage.allsellers.report') ? 'active' : ''}}"><a href="{{route('manage.allsellers.report')}}"><i class="fa fa-circle-o"></i>{{__('translations.allsellers_report')}}</a></li>
        @endif

        @if($logged_user->can('view sellers by kilo report') || $logged_user->can('Administer'))
        <li class="{{(Route::current()->getName() == 'manage.allsellers.kilo.report') ? 'active' : ''}}"><a href="{{route('manage.allsellers.kilo.report')}}"><i class="fa fa-circle-o"></i>{{__('translations.allsellers_bykilo_report')}}</a></li>
        @endif

      </ul>
    </li>
    <!--END Sellers-->

    <!--Stores-->
    <li class="treeview {{(Route::current()->getName() == 'manage.store.all' || Route::current()->getName() == 'manage.store.create' || Route::current()->getName() == 'manage.allstores.purchases' || Route::current()->getName() == 'manage.allstores.refunds' || Route::current()->getName() == 'manage.allstores.settlements' || Route::current()->getName() == 'manage.allstores.transfers' || Route::current()->getName() == 'manage.orders.shiped') ? 'active' : '' }}">

      <a href="#">
        <i class="fa fa-dashboard"></i> <span>{{__('translations.stores_management')}}</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        @if($logged_user->can('view all stores') || $logged_user->can('Administer'))
        <li class="{{(Route::current()->getName() == 'manage.store.all')? 'active' : ''}}"><a href="{{route('manage.store.all')}}"><i class="fa fa-circle-o"></i>{{__('translations.all_stores')}}</a></li>
        @endif

        @if($logged_user->can('create store') || $logged_user->can('Administer'))
        <li class="{{(Route::current()->getName() == 'manage.store.create')? 'active' : ''}}"><a href="{{route('manage.store.create')}}"><i class="fa fa-circle-o"></i>{{__('translations.create_store')}}</a></li>
        @endif

        @if($logged_user->can('view stores purchases') || $logged_user->can('Administer'))
        <li class="{{(Route::current()->getName() == 'manage.allstores.purchases')? 'active' : ''}}"><a href="{{route('manage.allstores.purchases')}}"><i class="fa fa-circle-o"></i>{{__('translations.stores_purchases')}}</a></li>
        @endif

        @if($logged_user->can('view shiped orders') || $logged_user->can('Administer'))
       <li class="treeview {{(Route::current()->getName() == 'manage.orders.shiped') ? 'active' : '' }}">
        <a href="{{route('manage.orders.shiped')}}"><i class="fa fa-sort-amount-desc"></i>{{__('translations.orders_shiped')}}</a>
       </li>
        @endif

        @if($logged_user->can('view store refunds') || $logged_user->can('Administer'))
        <li class="{{(Route::current()->getName() == 'manage.allstores.refunds')? 'active' : ''}}"><a href="{{route('manage.allstores.refunds')}}"><i class="fa fa-circle-o"></i>{{__('translations.stores_refunds')}}</a></li>
        @endif

        @if($logged_user->can('view store settlements') || $logged_user->can('Administer'))
        <li class="{{(Route::current()->getName() == 'manage.allstores.settlements')? 'active' : ''}}"><a href="{{route('manage.allstores.settlements')}}"><i class="fa fa-circle-o"></i>{{__('translations.stores_settlements')}}</a></li>
        @endif

        @if($logged_user->can('view store transfers') || $logged_user->can('Administer'))
        <li class="{{(Route::current()->getName() == 'manage.allstores.transfers')? 'active' : ''}}"><a href="{{route('manage.allstores.transfers')}}"><i class="fa fa-circle-o"></i>{{__('translations.stores_transfers')}}</a></li>
        @endif
      </ul>
    </li>
    <!--END Stores-->

    <!--banners-->
    <li class="treeview {{(Route::current()->getName() == 'manage.banners' || Route::current()->getName() == 'manage.banner.create' || Route::current()->getName() == 'manage.bannertypes' || Route::current()->getName() == 'manage.bannertype.create') ? 'active' : '' }}">

      <a href="#">
        <i class="fa fa-dashboard"></i> <span>{{__('translations.manage_banners')}}</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        @if($logged_user->can('view all banners') || $logged_user->can('Administer'))
        <li class="{{(Route::current()->getName() == 'manage.banners')? 'active' : ''}}"><a href="{{route('manage.banners')}}"><i class="fa fa-circle-o"></i>{{__('translations.all_banners')}}</a></li>
        @endif

        @if($logged_user->can('create banner') || $logged_user->can('Administer'))
        <li class="{{(Route::current()->getName() == 'manage.banner.create')? 'active' : ''}}"><a href="{{route('manage.banner.create')}}"><i class="fa fa-circle-o"></i>{{__('translations.add_banner')}}</a></li>
        @endif
      </ul>
    </li>
    <!--END banners-->

    <!--QUANTITIES-->
    <li class="treeview {{(Route::current()->getName() == 'manage.quantity.zero'||Route::current()->getName() == 'manage.quantity.three'||Route::current()->getName() == 'manage.quantity.lessThanZero') ? 'active' : '' }}">
      <a href="#">
        <i class="fa fa-dashboard"></i> <span>{{__('translations.quantities_managment')}}</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">

          @if($logged_user->can('view quantities rate') || $logged_user->can('Administer'))
          <li class="{{(Route::current()->getName() == 'manage.quantity.zero')? 'active' : ''}}"><a href="{{route('manage.quantity.zero')}}"><i style="color: red;" class="fa fa-exclamation-triangle"></i>{{__('translations.zero_quantity_products_alert')}}</a></li>
          @endif

          @if($logged_user->can('view quantities rate') || $logged_user->can('Administer'))
          <li class="{{(Route::current()->getName() == 'manage.quantity.three')? 'active' : ''}}"><a href="{{route('manage.quantity.three')}}"><i class="fa fa-circle-o"></i>{{__('translations.products_less_than_25')}}</a></li>
          @endif

          @if($logged_user->can('view quantities rate') || $logged_user->can('Administer'))
          <li class="{{(Route::current()->getName() == 'manage.quantity.lessThanZero')? 'active' : ''}}"><a href="{{route('manage.quantity.lessThanZero')}}"><i class="fa fa-circle-o"></i>{{__('translations.products_less_than_zero')}}</a></li>
          @endif

        </ul>
    </li>
    <!--END QUANTITIES-->

       @if($logged_user->can('search with bill') || $logged_user->can('Administer'))
       <li class="treeview {{(Route::current()->getName() == 'manage.search.bill') ? 'active' : '' }}">
        <a href="{{route('manage.search.bill')}}"><i class="fa fa-search"></i>{{__('translations.search_with_bill')}}</a>
      </li>
      @endif

      <!-- start logs -->
    <li class="treeview {{(Route::current()->getName() == 'owner.log' || Route::current()->getName() == 'userroles.getlog' || Route::current()->getName() == 'owner.requests') ? 'active' : '' }}">
     <?php /* @if(in_array('customer', session()->get('privileges')->toArray()) || in_array('general', session()->get('privileges')->toArray())) */?>
      <a href="#">
      <i class="fa fa-dashboard"></i> <span>{{__('translations.logs')}}</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        @if($logged_user->can('view panel log') || $logged_user->can('Administer'))
        <li class="{{(Route::current()->getName() == 'owner.log')? 'active' : ''}}"><a href="{{route('owner.log')}}"><i class="fa fa-refresh"></i>{{__('translations.log')}}</a></li>
        @endif

        @if($logged_user->can('view pos log') || $logged_user->can('Administer'))
          <li class="{{(Route::current()->getName() == 'owner.requests')? 'active' : ''}}"><a href="{{route('owner.requests')}}"><i class="fa fa-history"></i>
          {{__('translations.selling_requests')}}</a></li>
        @endif

        @if($logged_user->can('view panel log') || $logged_user->can('Administer'))
           <li class="{{(Route::current()->getName() == 'userroles.getlog')? 'active' : ''}}"><a href="{{route('userroles.getlog')}}"><i class="fa fa-refresh"></i>{{__('translations.userroles_getlog')}}</a></li>
       @endif
      </ul>
    </li>
    <!--END logs-->

      <!-- start admins -->
    <li class="treeview {{(Route::current()->getName() == 'admins.all' || Route::current()->getName() == 'admins.create') ? 'active' : '' }}">
     <?php /* @if(in_array('customer', session()->get('privileges')->toArray()) || in_array('general', session()->get('privileges')->toArray())) */?>
      <a href="#">
      <i class="fa fa-dashboard"></i> <span>{{__('translations.admins_management')}}</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
         @if($logged_user->can('all admins') || $logged_user->can('Administer'))
    <li class="{{(Route::current()->getName() == 'admins.all')? 'active' : ''}}"><a href="{{route('admins.all')}}"><i class="fa fa-list"></i>
    {{__('translations.all_admins')}}</a></li>
    </li>
    @endif

    @if($logged_user->can('add admin') || $logged_user->can('Administer'))
    <li class="{{(Route::current()->getName() == 'admins.create')? 'active' : ''}}"><a href="{{route('admins.create')}}"><i class="fa fa-plus"></i>
    {{__('translations.add_admins')}}</a></li>
    </li>
    @endif

      </ul>
    </li>
    <!--END admins-->

     <!-- start permissions -->
    <li class="treeview {{(Route::current()->getName() == 'permissions.create' || Route::current()->getName() == 'roles.create' || Route::current()->getName() == 'users.all.roles.assign') ? 'active' : '' }}">
     <?php /* @if(in_array('customer', session()->get('privileges')->toArray()) || in_array('general', session()->get('privileges')->toArray())) */?>
      <a href="#">
      <i class="fa fa-dashboard"></i> <span>{{__('translations.permissions_management')}}</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">

    @if($logged_user->can('get control permissions') || $logged_user->can('Administer'))
    <li class="{{(Route::current()->getName() == 'permissions.get.control')? 'active' : ''}}"><a href="{{route('permissions.get.control')}}"><i class="fa fa-plus"></i>{{__('translations.permissions_get_control')}}</a></li>
    </li>
    @endif

@if($logged_user->can('view all permissions') || $logged_user->can('Administer'))
    <li class="{{(Route::current()->getName() == 'permissions.all')? 'active' : ''}}"><a href="{{route('permissions.all')}}"><i class="fa fa-plus"></i>{{__('translations.all_permissions')}}</a></li>
    </li>
    @endif


     @if($logged_user->can('add role') || $logged_user->can('Administer'))
    <li class="{{(Route::current()->getName() == 'roles.create')? 'active' : ''}}"><a href="{{route('roles.create')}}"><i class="fa fa-plus"></i>
    {{__('translations.add_roles')}}</a></li>
    </li>
    @endif

     @if($logged_user->can('assign roles permissions') || $logged_user->can('Administer'))
     <li class="{{(Route::current()->getName() == 'users.all.roles.assign')? 'active' : ''}}"><a href="{{route('users.all.roles.assign')}}"><i class="fa fa-tasks"></i>
    {{__('translations.assign_users_roles')}}</a></li>
    </li>
    @endif

      </ul>
    </li>
    <!--END permissions -->

        <li><a href="{{route('owner.logout')}}"><i class="fa fa-sign-out"></i>{{__('translations.logout')}}</a></li>


    </ul>
  </section>
</aside>
