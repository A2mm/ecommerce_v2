<?php

Route::group(['middleware' => 'lang'], function () {

    Route::get('/trans/{locale}', function ($locale) 
    {
        \Session::put('language', $locale);      
         return back();
    });

// START OWNER SECTION
Route::group(['prefix' => 'owner'], function () {
    Route::get('login', ['as' => 'owner.login', 'uses' => 'OwnerController@getLogin']);
    Route::post('login', ['as' => 'owner.login.post', 'uses' => 'OwnerController@postLogin']);
    Route::get('dashboard', ['as' => 'owner.dashboard', 'uses' => 'OwnerController@getDashboard'])->middleware('owner');
    Route::get('graph', ['as' => 'owner.graph', 'uses' => 'OwnerController@getGraph'])->middleware('owner');
    Route::get('/market', ['as' => 'owner.manage.all.market', 'uses' => 'OwnerController@getMarket'])->middleware('owner');
    Route::get('logout', ['as' => 'owner.logout', 'uses' => 'OwnerController@getLogout']);
// END OWNER SECTION

//categories
    Route::get('/manage/categories/data', ['as' => 'manage.category.all.data', 'uses' => 'OwnerCategoryController@getData'])->middleware('owner');

    Route::get('/manage/categories', ['as' => 'manage.category.all', 'uses' => 'OwnerCategoryController@getShowAll'])->middleware('owner', 'permission:view all categories|Administer');

    Route::get('/manage/categories/create', ['as' => 'manage.category.create', 'uses' => 'OwnerCategoryController@getCreate'])->middleware('owner', 'permission:create category|Administer');

    Route::post('/manage/categories/store', ['as' => 'manage.category.store', 'uses' => 'OwnerCategoryController@postStore'])->middleware('owner', 'permission:create category|Administer');

    Route::get('/manage/categories/edit/{id}', ['as' => 'manage.category.edit', 'uses' => 'OwnerCategoryController@getEditCategory'])->middleware('owner', 'permission:edit category|Administer');

    Route::post('/manage/categories/edit/{id}', ['as' => 'manage.category.edit.post', 'uses' => 'OwnerCategoryController@postEditCategory'])->middleware('owner', 'permission:edit category|Administer');

    Route::get('/manage/categories/delete/{id}', ['as' => 'manage.category.delete', 'uses' => 'OwnerCategoryController@getDeleteCategory'])->middleware('owner', 'permission:delete category|Administer');

    Route::get('/manage/categories/online', ['as' => 'categories.online', 'uses' => 'CategoriesOnlineController@index'])->middleware('owner', 'permission:categories online|Administer');

    Route::get('/manage/categories/online/create', ['as' => 'categories.online.create', 'uses' => 'CategoriesOnlineController@create'])->middleware('owner', 'permission:categories online create|Administer');

    Route::post('/manage/categories/online/create', ['as' => 'categories.online.store', 'uses' => 'CategoriesOnlineController@store'])->middleware('owner', 'permission:categories online create|Administer');

    Route::get('/manage/categories/online/{categoryOnline}/edit', ['as' => 'categories.online.edit', 'uses' => 'CategoriesOnlineController@edit'])->middleware('owner', 'permission:categories online edit|Administer');

    Route::patch('/manage/categories/online/{categoryOnline}/edit', ['as' => 'categories.online.update', 'uses' => 'CategoriesOnlineController@update'])->middleware('owner', 'permission:categories online edit|Administer');

    Route::get('/manage/categories/online/{categoryOnline}', ['as' => 'categories.online.destroy', 'uses' => 'CategoriesOnlineController@destroy'])->middleware('owner', 'permission:categories online destroy|Administer');


    //subcategories
    Route::get('/manage/subcategories/data', ['as' => 'manage.subcategory.all.data', 'uses' => 'OwnerSubcategoryController@getData'])->middleware('owner');

    Route::get('/manage/subcategories', ['as' => 'manage.subcategory.all', 'uses' => 'OwnerSubcategoryController@getShowAll'])->middleware('owner', 'permission:view all subcategories|Administer');

    Route::get('/manage/subcategories/view/{id}', ['as' => 'manage.subcategory.view', 'uses' => 'OwnerSubcategoryController@getView'])->middleware('owner', 'permission:view specific subcategory|Administer');

    Route::get('/manage/subcategories/create', ['as' => 'manage.subcategory.create', 'uses' => 'OwnerSubcategoryController@getCreate'])->middleware('owner', 'permission:create subcategory|Administer');

    Route::post('/manage/subcategories/store', ['as' => 'manage.subcategory.store', 'uses' => 'OwnerSubcategoryController@postStore'])->middleware('owner', 'permission:create subcategory|Administer');

    Route::get('/manage/subcategories/edit/{id}', ['as' => 'manage.subcategory.edit', 'uses' => 'OwnerSubcategoryController@getEditCategory'])->middleware('owner', 'permission:edit subcategory|Administer');

    Route::post('/manage/subcategories/edit/{id}', ['as' => 'manage.subcategory.edit.post', 'uses' => 'OwnerSubcategoryController@postEditCategory'])->middleware('owner', 'permission:edit subcategory|Administer');

    Route::get('/manage/subcategories/delete/{id}', ['as' => 'manage.subcategory.delete', 'uses' => 'OwnerSubcategoryController@getDeleteCategory'])->middleware('owner', 'permission:delete subcategory|Administer');

    //Products
    Route::get('/manage/products/data', ['as' => 'manage.products.all.data', 'uses' => 'OwnerProductController@getData'])->middleware('owner');

    Route::get('/manage/products', ['as' => 'manage.products.all', 'uses' => 'OwnerProductController@getShowAll'])->middleware('owner', 'permission:view all products|Administer');

   Route::get('/manage/products/movements/{id}', ['as' => 'manage.products.all.movements', 'uses' => 'OwnerProductController@getShowMovements'])->middleware('owner', 'permission:view product movements|Administer');

    Route::get('/manage/products/archive', ['as' => 'manage.products.all.archive', 'uses' => 'OwnerProductController@getShowArchived'])->middleware('owner', 'permission:view archived products|Administer');

    Route::get('/manage/products/view/{id}', ['as' => 'manage.products.view', 'uses' => 'OwnerProductController@getView'])->middleware('owner', 'permission:view specific product|Administer');

    Route::get('/manage/products/create', ['as' => 'manage.products.create', 'uses' => 'OwnerProductController@getCreate'])->middleware('owner', 'permission:add product|Administer');

    Route::post('/manage/products/store', ['as' => 'manage.products.store', 'uses' => 'OwnerProductController@postStore'])->middleware('owner', 'permission:add product|Administer');

    Route::get('/manage/products/edit/{id}', ['as' => 'manage.products.edit', 'uses' => 'OwnerProductController@getEditProduct'])->middleware('owner', 'permission:edit product|Administer');

    Route::post('/manage/products/edit/{id}', ['as' => 'manage.products.edit.post', 'uses' => 'OwnerProductController@postEditProduct'])->middleware('owner', 'permission:edit product|Administer');

    Route::get('/manage/products/delete/{id}', ['as' => 'manage.products.delete', 'uses' => 'OwnerProductController@delete'])->middleware('owner', 'permission:delete product|Administer');

    Route::get('/manage/products/archive/{id}', ['as' => 'manage.products.archive', 'uses' => 'OwnerProductController@archiveToggle'])->middleware('owner', 'permission:archive product|unarchive product|Administer');

    Route::get('/manage/products/addDiscount/{id}', ['as' => 'manage.products.discount.get', 'uses' => 'OwnerProductController@getEditDiscount'])->middleware('owner', 'permission:product discount|Administer');

    Route::post('/manage/products/addDiscount/{id}', ['as' => 'manage.products.discount.post', 'uses' => 'OwnerProductController@postEditDiscount'])->middleware('owner', 'permission:product discount|Administer');

    Route::get('/manage/produc/view/codes/{id}',['as' => 'manage.products.codes','uses' => 'OwnerProductController@getProductCodes'])->middleware('owner');

    Route::get('/manage/products/refunds/',['as' => 'manage.products.refunds','uses' => 'OwnerProductController@manage_products_refunds'])->middleware('owner', 'permission:view refunds|Administer');

    Route::get('/manage/products/online/refunds/',['as' => 'manage.products.onlinerefunds','uses' => 'OwnerProductController@manage_products_onlinerefunds'])->middleware('owner', 'permission:view online refunds|Administer');

Route::get('/manage/products/view/history/{id}',['as' => 'manage.products.view.history','uses' => 'OwnerProductController@view_product_history'])->middleware('owner', 'permission:view product history|Administer');

    Route::get('/manage/products/view/product/prices/',['as' => 'manage.products.view.product.prices','uses' => 'OwnerProductController@view_product_prices'])->middleware('owner', 'permission:view product prices|Administer');

    Route::get('/manage/products/attributes/edit/{id}', ['as' => 'manage.products.edit.attributes', 'uses' => 'OwnerProductController@getAttributesProduct'])->middleware('owner');

    Route::post('/manage/products/attributes/edit/{id}', ['as' => 'manage.products.edit.attributes.post', 'uses' => 'OwnerProductController@postAttributesProduct'])->middleware('owner');

Route::get('/manage/product/price/{id}', ['as' => 'manage.products.price', 'uses' => 'OwnerProductController@manage_price'])->middleware('owner', 'permission:change product price|Administer');

    Route::post('/manage/product/price/', ['as' => 'manage.products.price.post', 'uses' => 'OwnerProductController@post_manage_price'])->middleware('owner', 'permission:change product price|Administer');

    Route::get('/manage/ads', ['as' => 'manage.ads.get', 'uses' => 'OwnerProductController@getAds'])->middleware('owner');

    Route::post('/manage/ads/post', ['as' => 'manage.ads.post', 'uses' => 'OwnerProductController@postAds'])->middleware('owner');

    Route::get('/manage/products/Quantity/{id}', ['as' => 'manage.products.Quantity', 'uses' => 'OwnerProductController@getQuantityView'])->middleware('owner', 'permission:change product quantity|Administer');

Route::post('/manage/products/Quantity/save', ['as' => 'manage.products.editQuantity.post', 'uses' => 'OwnerProductController@getQuantityView_post'])->middleware('owner', 'permission:change product quantity|Administer');

    Route::get('/manage/products/addQuantity/{id}', ['as' => 'manage.products.addQuantity', 'uses' => 'OwnerProductController@getAddQuantityProduct'])->middleware('owner', 'permission:change product quantity|Administer');

    Route::post('/manage/products/addQuantity/{id}', ['as' => 'manage.products.addQuantity.post', 'uses' => 'OwnerProductController@postAddQuantityProduct'])->middleware('owner', 'permission:change product quantity|Administer');

    Route::get('/manage/products/deleteQuantity/{id}', ['as' => 'manage.products.deleteQuantity', 'uses' => 'OwnerProductController@getDeleteQuantityProduct'])->middleware('owner', 'permission:change product quantity|Administer');

    Route::post('/manage/products/deleteQuantity/{id}', ['as' => 'manage.products.deleteQuantity.post', 'uses' => 'OwnerProductController@postDeleteQuantityProduct'])->middleware('owner', 'permission:change product quantity|Administer');

    Route::get('/manage/subcategories/edit/{id}', ['as' => 'manage.subcategory.edit', 'uses' => 'OwnerSubcategoryController@getEditCategory'])->middleware('owner', 'permission:edit subcategory|Administer');

    Route::post('/manage/subcategories/edit/{id}', ['as' => 'manage.subcategory.edit.post', 'uses' => 'OwnerSubcategoryController@postEditCategory'])->middleware('owner', 'permission:edit subcategory|Administer');

    Route::get('/manage/subcategories/delete/{id}', ['as' => 'manage.subcategory.delete', 'uses' => 'OwnerSubcategoryController@getDeleteCategory'])->middleware('owner', 'permission:delete subcategory|Administer');

    //orders
    Route::get('/manage/orders/data', ['as' => 'manage.orders.all.data', 'uses' => 'OwnerOrderController@getShowAll'])->middleware('owner');
    Route::get('/manage/orders', ['as' => 'manage.orders.all', 'uses' => 'OwnerOrderController@getShowAll'])->middleware('owner', 'o_shop');
    Route::get('/manage/orders/sendMail/{id}', ['as' => 'manage.orders.sendMail', 'uses' => 'OwnerOrderController@cartSendMail'])->middleware('owner');

// error access page
Route::get('/error/access', ['as' => 'errors.unauthorized_access', 'uses' => 'PermissionController@unauthorizedAccess'])->middleware('owner');
// start  role permission section

// permissions control
   Route::get('/control/used/permissions', ['as' => 'permissions.get.control', 'uses' => 'PermissionController@permissions_get_control'])->middleware('owner', 'permission:get control permissions|Administer');

   Route::get('/create/used/permissions', ['as' => 'permissions.used.create', 'uses' => 'PermissionController@create_used_permissions'])->middleware('owner', 'permission:create used permissions|Administer');

   Route::get('/delete/used/permissions', ['as' => 'permissions.used.delete', 'uses' => 'PermissionController@delete_used_permissions'])->middleware('owner', 'permission:delete used permissions|Administer');
// permissions control

// permissions
    Route::get('/all/permissions', ['as' => 'permissions.all', 'uses' => 'PermissionController@index'])->middleware('owner', 'permission:view all permissions|Administer');

    Route::get('/create/permissions', ['as' => 'permissions.create', 'uses' => 'PermissionController@create'])->middleware('owner', 'permission:add permission|Administer');

      Route::post('/store/permissions', ['as' => 'permissions.store', 'uses' => 'PermissionController@store'])->middleware('owner', 'permission:add permission|Administer');

      Route::get('/edit/permissions/{id}', ['as' => 'permissions.edit', 'uses' => 'PermissionController@edit'])->middleware('owner', 'permission:edit permission|Administer');

      Route::post('/update/permissions/{id}', ['as' => 'permissions.update', 'uses' => 'PermissionController@update'])->middleware('owner', 'permission:edit permission|Administer');

      Route::get('/delete/permissions/{id}', ['as' => 'permissions.destroy', 'uses' => 'PermissionController@destroy'])->middleware('owner');

// roles
    Route::get('/all/roles', ['as' => 'roles.all', 'uses' => 'RoleController@index'])->middleware('owner', 'permission:view all roles|Administer');

     Route::get('/create/roles', ['as' => 'roles.create', 'uses' => 'RoleController@create'])->middleware('owner', 'permission:add role|Administer');

      Route::post('/store/roles', ['as' => 'roles.store', 'uses' => 'RoleController@store'])->middleware('owner', 'permission:add role|Administer');

      Route::get('/edit/roles/{id}', ['as' => 'roles.edit', 'uses' => 'RoleController@edit'])->middleware('owner', 'permission:edit role|Administer');

      Route::post('/update/roles/{id}', ['as' => 'roles.update', 'uses' => 'RoleController@update'])->middleware('owner', 'permission:edit role|Administer');

      Route::get('/delete/roles/{id}', ['as' => 'roles.destroy', 'uses' => 'RoleController@destroy'])->middleware('owner', 'permission:delete role|Administer');

// assign to users
     Route::get('/assign/users/roles', ['as' => 'users.all.roles.assign', 'uses' => 'OwnerController@index'])->middleware('owner', 'permission:assign users roles|Administer');

 // log roles

    Route::get('/get/log/users/roles', ['as' => 'userroles.getlog', 'uses' => 'OwnerController@userroles_getlog'])->middleware('owner', 'permission:view panel log|Administer');

    Route::get('/get/specific/log/users/roles/{id}', ['as' => 'userroles.getlog.specific', 'uses' => 'OwnerController@userroles_getlog_specific'])->middleware('owner', 'permission:view panel log|Administer');

    Route::get('/assign/role/some/user/{id}', ['as' => 'users.roles.some', 'uses' => 'OwnerController@assign_roles'])->middleware('owner', 'permission:give admins roles|Administer');

       Route::post('/store/user/roles/{id}', ['as' => 'users.roles.store', 'uses' => 'OwnerController@store_roles'])->middleware('owner', 'assigning', 'permission:give admins roles|Administer');

       // create admins  admins.all
       Route::get('/all/admins', ['as' => 'admins.all', 'uses' => 'OwnerController@all_admins'])->middleware('owner', 'permission:all admins|Administer');

     Route::get('/create/admins', ['as' => 'admins.create', 'uses' => 'OwnerController@add_admins'])->middleware('owner', 'permission:add admin|Administer');

      Route::post('/store/admins', ['as' => 'admins.store', 'uses' => 'OwnerController@store_admins'])->middleware('owner', 'permission:add admin|Administer');

      Route::get('/suspend/admins/{id}', ['as' => 'alladmins.suspend', 'uses' => 'OwnerController@alladmins_suspend'])->middleware('owner', 'permission:suspend admin|Administer');

       Route::get('/edit/admins/{id}', ['as' => 'alladmins.edit', 'uses' => 'OwnerController@alladmins_edit'])->middleware('owner', 'permission:edit admin|Administer');

       Route::post('/store/edit/admins/{id}', ['as' => 'alladmins.edit.store', 'uses' => 'OwnerController@store_alladmins_edit'])->middleware('owner', 'permission:edit admin|Administer');
// end  role permission section

    //customers
    Route::get('/manage/customers/data', ['as' => 'manage.customers.all.data', 'uses' => 'OwnerCustomerController@getData'])->middleware('owner', 'o_customer');

    Route::get('/manage/customers', ['as' => 'manage.customers.all', 'uses' => 'OwnerCustomerController@getShowAll'])->middleware('owner', 'permission:view all clients|Administer');


    Route::get('/manage/customers/create', ['as' => 'manage.customers.create', 'uses' => 'OwnerCustomerController@getCreate'])->middleware('owner', 'permission:create client|Administer');

    Route::post('/manage/customers/save', ['as' => 'manage.customers.post', 'uses' => 'OwnerCustomerController@postCreate'])->middleware('owner', 'permission:create client|Administer');
// soal
Route::get('/manage/customers/get/usertype/history/', ['as' => 'manage.get.usertype.history', 'uses' => 'OwnerCustomerController@get_usertype_history'])->middleware('owner');

    Route::get('/manage/customers/edit/{id}', ['as' => 'manage.customers.edit', 'uses' => 'OwnerCustomerController@getEditCustomer'])->middleware('owner', 'permission:edit customer|Administer');

    Route::post('/manage/customers/edit/{id}', ['as' => 'manage.customers.edit.post', 'uses' => 'OwnerCustomerController@postEditCustomer'])->middleware('owner', 'permission:edit customer|Administer');

    Route::get('/manage/customers/block/{id}', ['as' => 'manage.customers.block', 'uses' => 'OwnerCustomerController@getBlockCustomer'])->middleware('owner', 'permission:suspend customer|Administer');

    Route::get('/manage/customers/unblock/{id}', ['as' => 'manage.customers.unblock', 'uses' => 'OwnerCustomerController@getUnBlockCustomer'])->middleware('owner', 'permission:unsuspend customer|Administer');

  // soal
    Route::get('/manage/customers/delete/{id}', ['as' => 'manage.customers.delete', 'uses' => 'OwnerCustomerController@getDeleteCustomer'])->middleware('owner');


    Route::get('/manage/customers/details/{id}', ['as' => 'manage.customers.details', 'uses' => 'OwnerCustomerController@getDetails'])->middleware('owner', 'permission:show customer orders|Administer');

Route::get('manage/customers/{id}/delete/order', ['as' => 'manage.customers.orders.delete', 'uses' => 'OwnerCustomerController@delete_order'])->middleware('owner');

// customers report
Route::get('/manage/all/customers/report', ['as' => 'manage.allcustomers.report', 'uses' => 'OwnerCustomerController@all_customers_report'])->middleware('owner', 'permission:view all customers report|Administer');

Route::get('/manage/view/customer/profile/{id}', ['as' => 'manage.customers.viewprofile', 'uses' => 'OwnerCustomerController@view_customer_profile'])->middleware('owner', 'permission:view customer profile data|Administer');

    //admins
    Route::get('/manage/admins/data', ['as' => 'manage.admins.all.data', 'uses' => 'OwnerAdminController@getData'])->middleware('owner', 'o_admin');
    Route::get('/manage/admins', ['as' => 'manage.admins.all', 'uses' => 'OwnerAdminController@getShowAll'])->middleware('owner', 'o_admin');
    Route::get('/manage/admins/create', ['as' => 'manage.admins.create', 'uses' => 'OwnerAdminController@getCreate'])->middleware('owner', 'o_admin');
    Route::post('/manage/admins/store', ['as' => 'manage.admins.store', 'uses' => 'OwnerAdminController@postStore'])->middleware('owner', 'o_admin');
    Route::get('/manage/admins/edit/{id}', ['as' => 'manage.admins.edit', 'uses' => 'OwnerAdminController@getEdit'])->middleware('owner', 'o_admin');
    Route::post('/manage/admins/edit/{id}', ['as' => 'manage.admins.edit.post', 'uses' => 'OwnerAdminController@postEdit'])->middleware('owner', 'o_admin');
    Route::get('/manage/admins/delete/{id}', ['as' => 'manage.admins.delete', 'uses' => 'OwnerAdminController@getDelete'])->middleware('owner', 'o_admin');

// quantity section
    Route::get('/manage/quantity/three/data', ['as' => 'manage.quantity.three.data', 'uses' => 'OwnerQuantityController@lessThanThreeData'])->middleware('owner');

    Route::get('/manage/quantity/twenty/five', ['as' => 'manage.quantity.three', 'uses' => 'OwnerQuantityController@lessThan25'])->middleware('owner', 'permission:view quantities rate|Administer');

    Route::get('/manage/quantity/zero/data', ['as' => 'manage.quantity.zero.data', 'uses' => 'OwnerQuantityController@zeroData'])->middleware('owner');

    Route::get('/manage/quantity/zero', ['as' => 'manage.quantity.zero', 'uses' => 'OwnerQuantityController@zero'])->middleware('owner', 'permission:view quantities rate|Administer');

    Route::get('/manage/quantity/lessThanZero', ['as' => 'manage.quantity.lessThanZero', 'uses' => 'OwnerQuantityController@lessThanZero'])->middleware('owner', 'permission:view quantities rate|Administer');

    //Owner
    Route::get('/manage/owners', ['as' => 'manage.owner.all', 'uses' => 'OwnerController@getShowAll'])->middleware('owner', 'o_owner');

    Route::get('/manage/owner/create', ['as' => 'manage.owner.create', 'uses' => 'OwnerController@getCreate'])->middleware('owner', 'o_owner');
    // Route::post('/manage/owner/store', ['as' => 'manage.owner.store', 'uses' => 'OwnerController@postStore'])->middleware('owner', 'o_owner');
    Route::get('/manage/owner/view/{id}', ['as' => 'manage.owners.view', 'uses' => 'OwnerController@getView'])->middleware('owner', 'o_owner');
    Route::get('/manage/owner/edit/{id}', ['as' => 'manage.owners.edit', 'uses' => 'OwnerController@edit'])->middleware('owner', 'o_owner');
    Route::post('/manage/owner/update/{id}', ['as' => 'manage.owner.update', 'uses' => 'OwnerController@update'])->middleware('owner', 'o_owner');
    Route::get('/manage/owner/delete/{id}', ['as' => 'manage.owners.delete', 'uses' => 'OwnerController@destroy'])->middleware('owner', 'o_owner');

    // all purchases including(pos purchases and only delivered purchases)

    Route::get('/manage/purchases/data', ['as' => 'manage.purchase.all.data', 'uses' => 'OwnerPurchaseController@getData'])->middleware('owner');

    Route::get('/manage/purchases', ['as' => 'manage.purchase.all', 'uses' => 'OwnerPurchaseController@getShowAll'])->middleware('owner');

    Route::get('/manage/purchases/delivered', ['as' => 'manage.purchase.all.delivered', 'uses' => 'OwnerPurchaseController@getShowAllDone'])->middleware('owner', 'permission:view transactions|Administer');

// new ahmed online delivered

    Route::get('/manage/purchases/online-delieverd', ['as' => 'delieverd.purchases', 'uses' => 'OwnerPurchaseController@delieverd2'])->middleware('owner', 'permission:delieverd purchases|Administer');

 // view delivered details
     Route::get('/manage/purchases/delivered/{id}', ['as' => 'delivered.show.details', 'uses' => 'OwnerPurchaseController@show_delivered_details2'])->middleware('owner', 'permission:view delivered order details|Administer');

      Route::get('/manage/purchases/delivered/{id}/{purchase_id}', ['as' => 'delivered.show.details.stores', 'uses' => 'OwnerPurchaseController@show_deivered_details_stores'])->middleware('owner', 'permission:view delivered order details|Administer');

    // online transactions
    Route::get('/manage/purchases/pending', ['as' => 'pending.purchases', 'uses' => 'OwnerPurchaseController@pending'])->middleware('owner', 'permission:pending purchases|Administer');
    Route::get('/manage/purchases/in-progress', ['as' => 'in_progress.purchases', 'uses' => 'OwnerPurchaseController@in_progress'])->middleware('owner', 'permission:in_progress purchases|Administer');
   
    Route::get('/manage/purchases/pending/{id}', ['as' => 'pending.show', 'uses' => 'OwnerPurchaseController@showPending'])->middleware('owner', 'permission:show pending|Administer');

   // view inprogress details
    Route::get('/manage/purchases/inprogress/{id}', ['as' => 'inprogress.show.details', 'uses' => 'OwnerPurchaseController@show_inprogress_details'])->middleware('owner', 'permission:view inprogress order details|Administer');

    // view cancelled details
    Route::get('/manage/purchases/cancelled/{id}', ['as' => 'cancelled.show.details', 'uses' => 'OwnerPurchaseController@show_cancelled_details'])->middleware('owner', 'permission:view cancelled order details|Administer');

    Route::get('/manage/purchases/cancelled', ['as' => 'cancelled.purchases', 'uses' => 'OwnerPurchaseController@cancelled'])->middleware('owner', 'permission:cancelled purchases|Administer');

    Route::PATCH('/manage/purchases/cancel/{id}', ['as' => 'manage.purchase.cancel', 'uses' => 'OwnerPurchaseController@cancelPurchase'])->middleware('owner', 'permission:cancel pending purchases|Administer');
    
    Route::PATCH('/manage/purchases/restore/{id}', ['as' => 'restore.purchase', 'uses' => 'OwnerPurchaseController@restorePurchase'])->middleware('owner', 'permission:restore cancelled purchases|Administer');

    // all online discount products
    Route::get('/manage/product/discount/{id}' , 'OnlineDiscountController@create')->name('online.discount.create')->middleware('owner', 'permission:create discount|Administer');
    Route::post('/manage/product/discount/{id}' , 'OnlineDiscountController@store')->name('online.discount.store')->middleware('owner', 'permission:create discount|Administer');
    Route::get('/manage/discount/product/{id}' , 'OnlineDiscountController@destroy')->name('online.discount.destroy')->middleware('owner', 'permission:delete discount|Administer');

    // all wholesale custommers report
    Route::get('/manage/wholesale/purchases/report', ['as' => 'manage.wholesale.customers.purchases', 'uses' => 'OwnerPurchaseController@all_wholesale_customers_purchases'])->middleware('owner', 'permission:view wholesale purchases report|Administer');

    Route::get('/manage/purchases/in_progress', ['as' => 'manage.purchase.all.in_progress', 'uses' => 'OwnerPurchaseController@getShowAllInProgress'])->middleware('owner', 'o_purchase');

    // Coupons
    Route::get('/manage/coupons', ['as' => 'coupon.index', 'uses' => 'CouponController@index'])->middleware('owner', 'permission:index coupon|Administer');
    Route::get('/manage/coupons/create', ['as' => 'coupon.create', 'uses' => 'CouponController@create'])->middleware('owner', 'permission:create coupon|Administer');
    Route::post('/manage/coupons/create', ['as' => 'coupon.store', 'uses' => 'CouponController@store'])->middleware('owner', 'permission:create coupon|Administer');
    Route::get('/manage/coupons/{id}', ['as' => 'coupon.show', 'uses' => 'CouponController@show'])->middleware('owner', 'permission:show coupon|Administer');
    Route::get('/manage/coupons/{id}/edit', ['as' => 'coupon.edit', 'uses' => 'CouponController@edit'])->middleware('owner', 'permission:edit coupon|Administer');
    Route::post('/manage/coupons/{id}/edit', ['as' => 'coupon.update', 'uses' => 'CouponController@update'])->middleware('owner', 'permission:edit coupon|Administer');
    Route::delete('/manage/coupons/{id}', ['as' => 'coupon.destroy', 'uses' => 'CouponController@destroy'])->middleware('owner', 'permission:delete coupon|Administer');

    // shipment
    Route::get('/manage/shipments' , ['as' => 'shipment.index', 'uses' => 'ShipmentController@index'])->middleware('owner', 'permission:shipments|Administer');
    Route::get('/manage/shipments/create' , ['as' => 'shipment.create', 'uses' => 'ShipmentController@create'])->middleware('owner', 'permission:shipment create|Administer');
    Route::post('/manage/shipments/create' , ['as' => 'shipment.store', 'uses' => 'ShipmentController@store'])->middleware('owner', 'permission:shipment create|Administer');
    Route::get('/manage/shipments/{id}/edit' , ['as' => 'shipment.edit', 'uses' => 'ShipmentController@edit'])->middleware('owner', 'permission:shipment edit|Administer');
    Route::patch('/manage/shipments/{id}/edit' , ['as' => 'shipment.update', 'uses' => 'ShipmentController@update'])->middleware('owner', 'permission:shipment edit|Administer');
    Route::delete('/manage/shipments/{id}' , ['as' => 'shipment.destroy', 'uses' => 'ShipmentController@destroy'])->middleware('owner', 'permission:shipment destroy|Administer');

    Route::get('/manage/purchases/edit/{id}', ['as' => 'manage.purchase.edit', 'uses' => 'OwnerPurchaseController@getEditPurchase'])->middleware('permission:purchase status|Administer');

    Route::post('/manage/purchases/edit/{id}', ['as' => 'manage.purchase.edit.post', 'uses' => 'OwnerPurchaseController@postEditPurchase'])->middleware('owner', 'permission:manage delieverd|Administer');
    Route::get('/manage/purchases/details/{id}', ['as' => 'manage.purchase.details', 'uses' => 'OwnerPurchaseController@getShowDetails'])->middleware('owner', 'o_purchase');
    Route::get('/manage/purchases/to_delivered/{id}', ['as' => 'manage.purchase.to_delivered', 'uses' => 'OwnerPurchaseController@to_delivered'])->middleware('owner', 'permission:manage delieverd|Administer');
    Route::get('/manage/purchases/delete/{id}', ['as' => 'manage.purchase.delete', 'uses' => 'OwnerPurchaseController@getDeletePurchase'])->middleware('owner', 'o_purchase');
    Route::get('/manage/purchase/refund',['as' => 'manage.purchase.refund','uses' => 'OwnerPurchaseController@getRefund'])->middleware('owner','o_purchase');
    Route::post('/manage/purchase/refund',['as' => 'manage.purchase.refund','uses' => 'OwnerPurchaseController@postRefund'])->middleware('owner','o_purchase');

    // Sellers
    Route::get('/manage/sellers', ['as' => 'manage.sellers.all', 'uses' => 'OwnerSellerController@getShowAll'])->middleware('owner', 'permission:view all sellers|Administer');

    Route::get('/manage/sellers/create', ['as' => 'manage.sellers.create', 'uses' => 'OwnerSellerController@getCreate'])->middleware('owner', 'permission:create seller|Administer');

    Route::post('/manage/sellers/store', ['as' => 'manage.sellers.store', 'uses' => 'OwnerSellerController@postStore'])->middleware('owner', 'permission:create seller|Administer');

    Route::get('/manage/sellers/edit/{id}', ['as' => 'manage.sellers.edit', 'uses' => 'OwnerSellerController@getEdit'])->middleware('owner', 'permission:edit seller|Administer');

    Route::post('/manage/sellers/edit/{id}', ['as' => 'manage.sellers.edit.post', 'uses' => 'OwnerSellerController@postEdit'])->middleware('owner', 'permission:edit seller|Administer');

    Route::get('/manage/sellers/suspend/{id}', ['as' => 'manage.sellers.suspend', 'uses' => 'OwnerSellerController@getSuspend'])->middleware('owner', 'permission:suspend seller|Administer');

    Route::get('/manage/sellers/stores/{vendor_id}', ['as' => 'manage.sellers.stores', 'uses' => 'OwnerSellerController@getVendorStores'])->middleware('owner');

    Route::get('/manage/sellers/{id}', ['as' => 'manage.sellers.view', 'uses' => 'OwnerSellerController@getView'])->middleware('owner', 'permission:view specific seller|Administer');

Route::get('seller/{id}/history', 'OwnerSellerController@specific_seller')->name('sellers.soldprods')->middleware('owner', 'permission:seller sold|Administer');

Route::get('seller/{id}/history/by/kilo', 'OwnerSellerController@view_seller_history_by_kilo')->name('sellers.kilo')->middleware('owner', 'permission:seller kilo history|Administer');

 Route::get('/manage/sellers/log/activities', ['as' => 'manage.sellers.log.activities', 'uses' => 'OwnerSellerController@sellers_log'])->middleware('owner');

 Route::get('/manage/sellers/specific/log/activities/{id}', ['as' => 'manage.sellers.specificlog.activities', 'uses' => 'OwnerSellerController@specific_log'])->middleware('owner');

  Route::get('/manage/all/sellers/report', ['as' => 'manage.allsellers.report', 'uses' => 'OwnerSellerController@all_sellers_report_differentstores'])->middleware('owner', 'permission:view sellers report|Administer');

 Route::get('/manage/all/sellers/bykilo/report', ['as' => 'manage.allsellers.kilo.report', 'uses' => 'OwnerSellerController@all_sellers_bykilo_report_differentstores'])->middleware('owner', 'permission:view sellers by kilo report|Administer');

  Route::get('/manage/requests', ['as' => 'owner.requests', 'uses' => 'OwnerController@requests_log3'])->middleware('owner', 'permission:view pos log|Administer');

  Route::get('/log/activities/api/specific/{id}', ['as' => 'specific.api.activity', 'uses' => 'OwnerController@specific_api_activity'])->middleware('owner');

    //REPORTS
    Route::get('/manage/report/all', ['as' => 'manage.report.all', 'uses' => 'OwnerReportController@getShowAll'])->middleware('owner', 'o_shop');

    Route::get('/manage/report/orders', ['as' => 'manage.report.orders', 'uses' => 'OwnerReportController@getOrders'])->middleware('owner', 'o_shop');

    Route::get('/manage/report/top', ['as' => 'manage.report.top', 'uses' => 'OwnerReportController@getTops'])->middleware('owner', 'o_shop');

    //Stores
    Route::get('/manage/stores/data', ['as' => 'manage.store.all.data', 'uses' => 'OwnerStoreController@getData'])->middleware('owner');

    Route::get('/manage/stores', ['as' => 'manage.store.all', 'uses' => 'OwnerStoreController@getShowAll'])->middleware('owner')->middleware('owner', 'permission:view all stores|Administer');

    Route::get('/manage/stores/create', ['as' => 'manage.store.create', 'uses' => 'OwnerStoreController@getCreate'])->middleware('owner', 'permission:create store|Administer');

    Route::post('/manage/stores/store', ['as' => 'manage.store.store', 'uses' => 'OwnerStoreController@postStore'])->middleware('owner', 'permission:create store|Administer');

    // Pdf Generators

    Route::get('/manage/stores/reports', ['as' => 'manage.store.reports', 'uses' => 'OwnerStoreController@index'])->middleware('owner');

    Route::get('/manage/stores/reports/pdf', ['as' => 'manage.store.reports.pdf', 'uses' => 'OwnerStoreController@pdf'])->middleware('owner');


    Route::get('/manage/store/print/week/{id}', ['as' => 'manage.store.print.week', 'uses' => 'OwnerStoreController@print_week'])->middleware('owner', 'permission:print store week|Administer');
// soal
    Route::get('/manage/stores/week/pdf/{id}', ['as' => 'manage.store.week.pdf', 'uses' => 'OwnerStoreController@pdfweek'])->middleware('owner');

     /* shiporder */

Route::get('/manage/log', ['as' => 'owner.log', 'uses' => 'OwnerController@log2'])->middleware('owner', 'permission:view panel log|Administer');

// added tags 

Route::get('/view/all/tags/{id}', ['as' => 'product.alltags', 'uses' => 'OwnerProductController@alltags'])->middleware('owner', 'permission:view all tags|Administer');

Route::get('/create/tags/{id}', ['as' => 'product.createtag', 'uses' => 'OwnerProductController@createtag'])->middleware('owner', 'permission:create tag|Administer');

Route::post('/create/tags/save', ['as' => 'product.createtag.save', 'uses' => 'OwnerProductController@createtag_save'])->middleware('owner', 'permission:create tag|Administer');

Route::get('/edit/tags/{id}', ['as' => 'product.edittag', 'uses' => 'OwnerProductController@edittag'])->middleware('owner', 'permission:edit tag|Administer');

Route::post('/edit/tags/save', ['as' => 'product.edittag.save', 'uses' => 'OwnerProductController@edittag_save'])->middleware('owner', 'permission:edit tag|Administer');

Route::get('/delete/tags/{id}', ['as' => 'product.deletetag', 'uses' => 'OwnerProductController@deletetag'])->middleware('owner', 'permission:delete tag|Administer');

Route::get('/manage/specific/log/{id}', ['as' => 'manage.activities.specific', 'uses' => 'OwnerController@specific_log'])->middleware('owner', 'permission:view panel log|Administer');

// specfic api request and response
Route::get('/manage/specific/log/request/{id}', ['as' => 'manage.activities.specific.request', 'uses' => 'OwnerController@specific_log_request'])->middleware('owner', 'permission:view pos log|Administer');

Route::get('/manage/products/ship/order/{id}',['as' => 'manage.products.ship.order','uses' => 'OwnerStoreController@ship_order'])->middleware('owner', 'permission:store ship order|Administer');

Route::post('/manage/products/ship/order',['as' => 'manage.stores.post.shiporder','uses' => 'OwnerStoreController@post_ship_order'])->middleware('owner', 'permission:store ship order|Administer');

/*   add order */
// soal
   Route::get('/manage/add/order', ['as' => 'manage.add.order', 'uses' => 'OwnerStoreController@add_order'])->middleware('owner');

 Route::get('/manage/all/stores/purchases', ['as' => 'manage.allstores.purchases', 'uses' => 'OwnerStoreController@allstores_purchases2'])->middleware('owner', 'permission:view stores purchases|Administer');

 Route::get('search/with/bill', ['as' => 'manage.search.bill', 'uses' => 'OwnerPurchaseController@search_with_bill2'])->middleware('permission:search with bill|Administer');

/* start shiped orders */

Route::get('manage/shiped/orders', ['as' => 'manage.orders.shiped', 'uses' => 'OwnerStoreController@shiped_orders'])->middleware('owner', 'permission:view shiped orders|Administer');

Route::get('edit/shiped/orders/details/{id}', ['as' => 'edit.shipedorders.details', 'uses' => 'OwnerStoreController@view_shipedorders_details'])->middleware('owner', 'permission:edit shipedorders details|Administer');

// edit.refunds.details 
Route::get('edit/refunds/details/{id}', ['as' => 'edit.refunds.details', 'uses' => 'OwnerStoreController@view_refunds_details'])->middleware('owner', 'permission:edit refunds details|Administer');

// edit shiped orders items start

Route::get('/refunds/edit/store/{id}', ['as' => 'refunds.edit.store_id', 'uses' => 'OwnerStoreController@edit_refunds_store'])->middleware('owner', 'permission:edit refunds store|Administer');
Route::post('/refunds/edit/store/save', ['as' => 'refunds.edit.store_id.save', 'uses' => 'OwnerStoreController@edit_refunds_store_save'])->middleware('owner', 'permission:edit refunds store|Administer');

Route::get('/refunds/edit/number/{id}', ['as' => 'refunds.edit.refund_id', 'uses' => 'OwnerStoreController@edit_refunds_number'])->middleware('owner', 'permission:edit refunds number|Administer');
Route::post('/refunds/edit/number/save', ['as' => 'refunds.edit.refund_id.save', 'uses' => 'OwnerStoreController@edit_refunds_number_save'])->middleware('owner', 'permission:edit refunds number|Administer');

Route::get('/refunds/edit/product/{id}', ['as' => 'refunds.edit.product_id', 'uses' => 'OwnerStoreController@edit_refunds_product'])->middleware('owner', 'permission:edit refunds product|Administer');
Route::post('/refunds/edit/product/save', ['as' => 'refunds.edit.product_id.save', 'uses' => 'OwnerStoreController@edit_refunds_product_save'])->middleware('owner', 'permission:edit refunds product|Administer');

Route::get('/refunds/edit/quantity/{id}', ['as' => 'refunds.edit.quantity', 'uses' => 'OwnerStoreController@edit_refunds_quantity'])->middleware('owner', 'permission:edit refunds quantity|Administer');
Route::post('/refunds/edit/quantity/save', ['as' => 'refunds.edit.quantity.save', 'uses' => 'OwnerStoreController@edit_refunds_quantity_save'])->middleware('owner', 'permission:edit refunds quantity|Administer');

// edit shiped orders items end
// edit.refunds.details

/* start transfers details */
 
Route::get('edit/transfers/details/{id}', ['as' => 'edit.transfers.details', 'uses' => 'OwnerStoreController@view_transfers_details'])->middleware('owner', 'permission:edit transfers details|Administer');

Route::get('/transfers/edit/store/{id}', ['as' => 'transfers.edit.store_id', 'uses' => 'OwnerStoreController@edit_transfers_store'])->middleware('owner', 'permission:edit transfers store|Administer');
Route::post('/transfers/edit/store/save', ['as' => 'transfers.edit.store_id.save', 'uses' => 'OwnerStoreController@edit_transfers_store_save'])->middleware('owner', 'permission:edit transfers store|Administer');

Route::get('/transfers/edit/number/{id}', ['as' => 'transfers.edit.transfer_id', 'uses' => 'OwnerStoreController@edit_transfers_number'])->middleware('owner', 'permission:edit transfers number|Administer');
Route::post('/transfers/edit/number/save', ['as' => 'transfers.edit.transfer_id.save', 'uses' => 'OwnerStoreController@edit_transfers_number_save'])->middleware('owner', 'permission:edit transfers number|Administer');

Route::get('/transfers/edit/product/{id}', ['as' => 'transfers.edit.product_id', 'uses' => 'OwnerStoreController@edit_transfers_product'])->middleware('owner', 'permission:edit transfers product|Administer');
Route::post('/transfers/edit/product/save', ['as' => 'transfers.edit.product_id.save', 'uses' => 'OwnerStoreController@edit_transfers_product_save'])->middleware('owner', 'permission:edit transfers product|Administer');

Route::get('/transfers/edit/quantity/{id}', ['as' => 'transfers.edit.quantity', 'uses' => 'OwnerStoreController@edit_transfers_quantity'])->middleware('owner', 'permission:edit transfers quantity|Administer');
Route::post('/transfers/edit/quantity/save', ['as' => 'transfers.edit.quantity.save', 'uses' => 'OwnerStoreController@edit_transfers_quantity_save'])->middleware('owner', 'permission:edit transfers quantity|Administer');


/* end transfers details */

/* start settles details */
 
Route::get('edit/settles/details/{id}', ['as' => 'edit.settles.details', 'uses' => 'OwnerStoreController@view_settles_details'])->middleware('owner', 'permission:edit settles details|Administer');

Route::get('/settles/edit/store/{id}', ['as' => 'settles.edit.store_id', 'uses' => 'OwnerStoreController@edit_settles_store'])->middleware('owner', 'permission:edit settles store|Administer');
Route::post('/settles/edit/store/save', ['as' => 'settles.edit.store_id.save', 'uses' => 'OwnerStoreController@edit_settles_store_save'])->middleware('owner', 'permission:edit settles store|Administer');

Route::get('/settles/edit/number/{id}', ['as' => 'settles.edit.settle_id', 'uses' => 'OwnerStoreController@edit_settles_number'])->middleware('owner', 'permission:edit settles number|Administer');
Route::post('/settles/edit/number/save', ['as' => 'settles.edit.settle_id.save', 'uses' => 'OwnerStoreController@edit_settles_number_save'])->middleware('owner', 'permission:edit settles number|Administer');

Route::get('/settles/edit/product/{id}', ['as' => 'settles.edit.product_id', 'uses' => 'OwnerStoreController@edit_settles_product'])->middleware('owner', 'permission:edit settles product|Administer');
Route::post('/settles/edit/product/save', ['as' => 'settles.edit.product_id.save', 'uses' => 'OwnerStoreController@edit_settles_product_save'])->middleware('owner', 'permission:edit settles product|Administer');

Route::get('/settles/edit/quantity/{id}', ['as' => 'settles.edit.quantity', 'uses' => 'OwnerStoreController@edit_settles_quantity'])->middleware('owner', 'permission:edit settles quantity|Administer');
Route::post('/settles/edit/quantity/save', ['as' => 'settles.edit.quantity.save', 'uses' => 'OwnerStoreController@edit_settles_quantity_save'])->middleware('owner', 'permission:edit settles quantity|Administer');

/* end settles details */

Route::get('/ship/known/order/{id}', ['as' => 'ship.known.order', 'uses' => 'OwnerStoreController@ship_known_order'])->middleware('owner', 'permission:ship known order|Administer');

Route::post('/ship/known/order/save', ['as' => 'ship.known.order.save', 'uses' => 'OwnerStoreController@ship_known_order_save'])->middleware('owner', 'permission:ship known order|Administer');

/* start add refund */
Route::get('/stock/add/refund/{id}', ['as' => 'stock.add.refund', 'uses' => 'OwnerStoreController@stock_add_refund'])->middleware('owner', 'permission:add new stock refund|Administer');

Route::post('/stock/add/refund/save', ['as' => 'stock.add.refund.save', 'uses' => 'OwnerStoreController@stock_add_refund_save'])->middleware('owner', 'permission:add new stock refund|Administer');
/* end add refund */

/* start add settle */
Route::get('/stock/add/settle/{id}', ['as' => 'stock.add.settle', 'uses' => 'OwnerStoreController@stock_add_settle'])->middleware('owner', 'permission:add new stock settle|Administer');

Route::post('/stock/add/settle/save', ['as' => 'stock.add.settle.save', 'uses' => 'OwnerStoreController@stock_add_settle_save'])->middleware('owner', 'permission:add new stock settle|Administer');
/* end add settle */

/* start add transfer */
Route::get('/stock/add/transfer/{id}', ['as' => 'stock.add.transfer', 'uses' => 'OwnerStoreController@stock_add_transfer'])->middleware('owner', 'permission:add new stock transfer|Administer');

Route::post('/stock/add/transfer/save', ['as' => 'stock.add.transfer.save', 'uses' => 'OwnerStoreController@stock_add_transfer_save'])->middleware('owner', 'permission:add new stock transfer|Administer');
/* end add transfer */

 // transfer 
Route::get('/manage/transfer/order/{id}', ['as' => 'manage.store.transferorder', 'uses' => 'OwnerStoreController@transfer_order'])->middleware('owner', 'permission:transfer order|Administer');
 
Route::post('/manage/transfer/order/save', ['as' => 'transfer.order.save', 'uses' => 'OwnerStoreController@transfer_order_save'])->middleware('owner', 'permission:transfer order|Administer');

  // refund stock   
Route::get('/manage/refund/stock/{id}', ['as' => 'refund.stock', 'uses' => 'OwnerStoreController@refund_stock'])->middleware('owner', 'permission:refund stock|Administer');
 
Route::post('/manage/refund/stock/save', ['as' => 'refund.stock.save', 'uses' => 'OwnerStoreController@refund_stock_save'])->middleware('owner', 'permission:refund stock|Administer');
 

 // settle stock   
Route::get('/manage/settle/stock/{id}', ['as' => 'settle.stock', 'uses' => 'OwnerStoreController@settle_stock'])->middleware('owner', 'permission:settle stock|Administer');
 
Route::post('/manage/settle/stock/save', ['as' => 'settle.stock.save', 'uses' => 'OwnerStoreController@settle_stock_save'])->middleware('owner', 'permission:settle stock|Administer');
 
// sidebar new stores pages  start

Route::get('/manage/stores/all/refunds', ['as' => 'manage.allstores.refunds', 'uses' => 'OwnerStoreController@allstores_refunds'])->middleware('owner', 'permission:view store refunds|Administer');
 
 Route::get('/manage/stores/all/settlements', ['as' => 'manage.allstores.settlements', 'uses' => 'OwnerStoreController@allstores_settlements'])->middleware('owner', 'permission:view store settlements|Administer');
 
 Route::get('/manage/stores/all/transfers', ['as' => 'manage.allstores.transfers', 'uses' => 'OwnerStoreController@allstores_transfers'])->middleware('owner', 'permission:view store transfers|Administer');

// sidebar new stores pages end


// edit shiped orders items start

Route::get('/shiped/orders/edit/store/{id}', ['as' => 'shipedorders.edit.store_id', 'uses' => 'OwnerStoreController@edit_shipedorders_store'])->middleware('owner', 'permission:edit shipedorders store|Administer');
Route::post('/shiped/orders/edit/store/save', ['as' => 'shipedorders.edit.store_id.save', 'uses' => 'OwnerStoreController@edit_shipedorders_store_save'])->middleware('owner', 'permission:edit shipedorders store|Administer');

Route::get('shiped/orders/edit/number/{id}', ['as' => 'shipedorders.edit.shiporder_id', 'uses' => 'OwnerStoreController@edit_shipedorders_number'])->middleware('owner', 'permission:edit shipedorders number|Administer');
Route::post('shiped/orders/edit/number/save', ['as' => 'shipedorders.edit.shiporder_id.save', 'uses' => 'OwnerStoreController@edit_shipedorders_number_save'])->middleware('owner', 'permission:edit shipedorders number|Administer');

Route::get('/shiped/orders/edit/product/{id}', ['as' => 'shipedorders.edit.product_id', 'uses' => 'OwnerStoreController@edit_shipedorders_product'])->middleware('owner', 'permission:edit shipedorders product|Administer');
Route::post('/shiped/orders/edit/product/save', ['as' => 'shipedorders.edit.product_id.save', 'uses' => 'OwnerStoreController@edit_shipedorders_product_save'])->middleware('owner', 'permission:edit shipedorders product|Administer');

Route::get('/shiped/orders/edit/quantity/{id}', ['as' => 'shipedorders.edit.quantity', 'uses' => 'OwnerStoreController@edit_shipedorders_quantity'])->middleware('owner', 'permission:edit shipedorders quantity|Administer');
Route::post('/shiped/orders/edit/quantity/save', ['as' => 'shipedorders.edit.quantity.save', 'uses' => 'OwnerStoreController@edit_shipedorders_quantity_save'])->middleware('owner', 'permission:edit shipedorders quantity|Administer');

// edit shiped orders items end

Route::get('manage/bill/details', ['as' => 'manage.get.bill.details', 'uses' => 'OwnerStoreController@get_bill_details'])->middleware('owner', 'permission:search with bill|Administer');

/* end shiped orders */

/* end order */

    Route::get('/manage/stores/show/{id}', ['as' => 'manage.store.show', 'uses' => 'OwnerStoreController@getShowStore'])->middleware('owner', 'permission:view store quantities|Administer');

    Route::get('/manage/stores/purchases/{id}', ['as' => 'manage.store.purchases', 'uses' => 'OwnerStoreController@getShowStorePurchases'])->middleware('owner', 'permission:view store purchases|Administer');

    Route::get('/manage/stores/movements/{id}', ['as' => 'manage.store.movements', 'uses' => 'OwnerStoreController@getShowMovements'])->middleware('owner', 'permission:view store products movements|Administer');

    Route::get('/manage/stores/sellers/{id}', ['as' => 'manage.store.sellers', 'uses' => 'OwnerStoreController@getShowSellers'])->middleware('owner', 'permission:view store sellers|Administer');

    Route::get('/manage/stores/edit/{id}', ['as' => 'manage.store.edit', 'uses' => 'OwnerStoreController@getEditStore'])->middleware('owner', 'permission:edit store|Administer');

    Route::post('/manage/stores/edit/{id}', ['as' => 'manage.store.edit.post', 'uses' => 'OwnerStoreController@postEditStore'])->middleware('owner', 'permission:edit store|Administer');

    Route::get('/manage/stores/delete/{id}', ['as' => 'manage.store.delete', 'uses' => 'OwnerStoreController@getDeleteStore'])->middleware('owner', 'permission:delete store|Administer');

    // attribute_type

    Route::get('manage/attributeType/create',['as' =>'manage.attributeType.create','uses' => 'AttributeTypeController@create'])->middleware('owner');
    Route::post('manage/attributeType/create',['as' => 'manage.attributeType.store','uses' =>'AttributeTypeController@store'])->middleware('owner');
    Route::get('manage/attributeType',['as' => 'manage.attributeTypes','uses' => 'AttributeTypeController@index'])->middleware('owner');
    Route::get('manage/attributeType/edit/{id}',['as' => 'manage.attributeType.edit','uses' => 'AttributeTypeController@edit'])->middleware('owner');
    Route::post('manage/attributeType/update/{id}',['as' => 'manage.attributeType.update','uses' => 'AttributeTypeController@update'])->middleware('owner');
    Route::get('manage/attributeType/delete/{id}',['as' => 'manage.attributeType.delete','uses' => 'AttributeTypeController@destroy'])->middleware('owner');
    Route::get('manage/attributeType/getdata',['as' => 'manage.attributeType.getdata','uses' => 'AttributeTypeController@getData'])->middleware('owner');
    Route::get('manage/attributeType/show/{id}',['as' => 'manage.attributeType.show','uses' => 'AttributeTypeController@show'])->middleware('owner');


    //attributes
    Route::get('manage/attribute/create/{attributeTypeId}',['as' =>'manage.attribute.create','uses' => 'AttributeController@create'])->middleware('owner');
    Route::post('manage/attribute/create',['as' => 'manage.attribute.store','uses' =>'AttributeController@store'])->middleware('owner');
    Route::get('manage/attribute',['as' => 'manage.attributes','uses' => 'AttributeController@index'])->middleware('owner');
    Route::get('manage/attribute/edit/{id}',['as' => 'manage.attribute.edit','uses' => 'AttributeController@edit'])->middleware('owner');
    Route::post('manage/attribute/update/{id}',['as' => 'manage.attribute.update','uses' => 'AttributeController@update'])->middleware('owner');
    Route::post('manage/attribute/delete/{id}',['as' => 'manage.attribute.delete','uses' => 'AttributeController@destroy'])->middleware('owner');
    Route::get('manage/attribute/getdata',['as' => 'manage.attribute.getdata','uses' => 'AttributeController@getData'])->middleware('owner');
    Route::get('attributeTypes/{id}/attributes',['as' => 'manage.attribute.attributes','uses' => 'OwnerSubcategoryController@attributes']);
    Route::get('subcategory/{subCategoryId}/attributeType/{attributeTypeId}',['as' => 'manage.attribute.edit.subcategory','uses' => 'OwnerSubcategoryController@subAttributeTypeAttributes'])->middleware('owner');
    Route::get('subcategory/{sbcategoryId}/attributeTypes',['as' => 'manage.subcategory.attributeTypes','uses' => 'OwnerSubcategoryController@attributeTypes'])->middleware('owner');
    Route::get('subcategory/{subCategoryId}/attributeType/{attributeTypeId}/notIncluded',['as' => 'manage.attribute.edit.subcategory','uses' => 'OwnerSubcategoryController@subAttributeTypeAttributesNotIncluded'])->middleware('owner');
    Route::get('subcategory/{subcategoryId}/notIncludedAttributeType/',['as' => 'manage.attributetypes.subcategory','uses' => 'OwnerSubcategoryController@attributeTypesNotincluded'])->middleware('owner');


    // slider
    Route::get('manage/slider/create',['as' => 'manage.slider.create','uses' =>'SliderController@create'])->middleware('owner');
    Route::get('manage/sliders',['as'=>'manage.sliders','uses'=>'SliderController@index'])->middleware('owner');
    Route::post('manage/slider/create',['as' => 'manage.slider.store','uses' => 'SliderController@store'])->middleware('owner');
    Route::get('manage/slider/show/{id}',['as' => 'manage.slider.show','uses' => 'SliderController@show'])->middleware('owner');
    Route::get('manage/slider/edit/{id}',['as' => 'manage.slider.edit','uses' => 'SliderController@edit'])->middleware('owner');
    Route::post('manage/slider/edit/{id}',['as' => 'manage.slider.update','uses' => 'SliderController@update'])->middleware('owner');
    Route::post('manage/slider/delete/{id}',['as' => 'manage.slider.delete','uses' => 'SliderController@destroy'])->middleware('owner');


    // banner
    Route::get('manage/banner/create',['as' => 'manage.banner.create','uses' =>'BannerController@create'])->middleware('owner', 'permission:create banner|Administer');

    Route::post('manage/banner/create',['as' => 'manage.banner.store','uses' => 'BannerController@store'])->middleware('owner', 'permission:create banner|Administer');

    Route::get('manage/banners',['as'=>'manage.banners','uses'=>'BannerController@index'])->middleware('owner', 'permission:view all banners|Administer');
    
    Route::get('manage/banner/edit/{id}',['as' => 'manage.banner.edit','uses' => 'BannerController@edit'])->middleware('owner', 'permission:edit banner|Administer');

    Route::post('manage/banner/edit/{id}',['as' => 'manage.banner.update','uses' => 'BannerController@update'])->middleware('owner', 'permission:edit banner|Administer');

    Route::get('manage/banner/show/{id}',['as' => 'manage.banner.show','uses' => 'BannerController@show'])->middleware('owner', 'permission:view banner details|Administer');

    Route::get('manage/banner/delete/{id}',['as' => 'manage.banner.delete','uses' => 'BannerController@destroy'])->middleware('owner', 'permission:delete banner|Administer');

});

});  // refers to lang braces



// all excel routes
Route::get('/excel/products' , 'OwnerProductController@excel')->name('excel.products');
Route::get('/excel/purchases' , 'OwnerPurchaseController@excel')->name('excel.purchases');

// start excel feedback

Route::get('/allDone/purchases/{from}/{to}' , 'OwnerPurchaseController@ahmed')->name('excel.ahmed');
Route::get('/allCustomerss/{from}/{to}' , 'OwnerCustomerController@ahmed')->name('allCustomerss.excel');
// Route::get('/AllCustomers/{from}/{to}' , 'OwnerCustomerController@ahmed')->name('AllCustomers.excel');
Route::get('/allWholesalePurchases/{from}/{to}' , 'OwnerPurchaseController@allWholesalePurchases')->name('allWholesalePurchases.excel');
Route::get('/allRefunds/{from}/{to}' , 'OwnerProductController@allRefunds_excel')->name('allRefunds.excel');
Route::get('/storeMovements/{id}/{from}/{to}/{search_index}' , 'OwnerStoreController@storeMovements_excel')->name('storeMovements.excel');
Route::get('/showStore/{id}/{search_index}' , 'OwnerStoreController@showStore_excel')->name('showStore.excel');
Route::get('/storesRefunds/{from}/{to}' , 'OwnerStoreController@storesRefunds_excel')->name('storesRefunds.excel');
Route::get('/storesSettles/{from}/{to}' , 'OwnerStoreController@storesSettles_excel')->name('storesSettles.excel');
Route::get('/storesTransfers/{from}/{to}' , 'OwnerStoreController@storesTransfers_excel')->name('storesTransfers.excel');
Route::get('/storesShipedOrders/{from}/{to}' , 'OwnerStoreController@storesShipedOrders_excel')->name('storesShipedOrders.excel');
Route::get('/allSellersKilo/{from}/{to}' , 'OwnerSellerController@allSellersKilo_excel')->name('allSellersKilo.excel');

Route::get('/panelLog/excel/{from_day}/{to_day}/{subject_type}/{description}' , 'OwnerController@panelLog_excel')->name('panelLog.excel');

Route::get('/requestLog/excel/{from_day}/{to_day}/{subject_type}/{auth_id}/{result}' , 'OwnerController@requestLog_excel')->name('requestLog.excel');

Route::get('/giveRolesLog/excel' , 'OwnerController@giveRolesLog_excel')->name('giveRolesLog.excel');
Route::get('/eachStorePurchases/excel/{id}/{from}/{to}', 'OwnerStoreController@eachStorePurchases_excel')->name('eachStorePurchases.excel');

// end excel feedback
Route::get('/excel/product/prices' , 'OwnerProductController@prices_excel')->name('excel.product.prices');
Route::get('/excel/customers' , 'OwnerCustomerController@excel')->name('excel.customers');
Route::get('/excel/customer/details/{id}/{from}/{to}' , 'OwnerCustomerController@details_excel')->name('eachCustomerPurchases.excel');
Route::get('/excel/customer/reports' , 'OwnerCustomerController@reports_excel')->name('excel.customer.reports');
Route::get('/excel/refunds' , 'OwnerProductController@refunds_excel')->name('excel.product.refunds');
Route::get('/excel/sellers' , 'OwnerSellerController@excel')->name('excel.sellers');
Route::get('/excel/sellers/reports/{from}/{to}' , 'OwnerSellerController@reports_excel')->name('excel.sellers.reports');
Route::get('/excel/stores' , 'OwnerStoreController@excel')->name('excel.stores');
Route::get('/excel/store/purchases' , 'OwnerStoreController@purchases_excel')->name('excel.store.purchases');
Route::get('/excel/store/products' , 'OwnerStoreController@products_excel')->name('excel.store.products');
Route::get('/excel/store/week' , 'OwnerStoreController@week_excel')->name('excel.store.week');
Route::get('/excel/stores/purchases/{from}/{to}' , 'OwnerStoreController@purchases2_excel')->name('excel.stores.purchases');
Route::get('/excel/quantity/zero' , 'OwnerQuantityController@zero_excel')->name('excel.quantity.zero');
Route::get('/excel/quantity/twenty-five' , 'OwnerQuantityController@twentyFive_excel')->name('excel.quantity.twentyFive');
Route::get('/excel/quantity/less-zero' , 'OwnerQuantityController@lessZero_excel')->name('excel.quantity.lessZero');
Route::get('/excel/stores/orders' , 'OwnerStoreController@orders_excel')->name('excel.stores.orders');
