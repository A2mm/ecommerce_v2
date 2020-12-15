<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script>
<script>

  $(document).on('click', '.delete',function(e){

  e.preventDefault();

  var url = ($(this).attr('data-href'));

    swal({

      title: "{{__('translations.are_you_sure_you_want_to_delete')}}",

      type: "warning",

      showCancelButton: true,

      confirmButtonColor: "#F5D313",

      confirmButtonText: "{{__('translations.yes_delete_it')}}",

      closeOnConfirm: false

    },

         function(){

          window.location=url;

    });

  });
  $(document).on('click', '.suspend',function(e){

  e.preventDefault();

  var url = ($(this).attr('data-href'));

    swal({

      title: "{{__('translations.are_you_sure_you_want_to_suspend_this_user')}}",

      type: "warning",

      showCancelButton: true,

      confirmButtonColor: "#F5D313",

      confirmButtonText: "{{__('translations.yes_suspend')}}",

      closeOnConfirm: false

    },

         function(){

          window.location=url;

    });

  });

</script>

<script type="text/javascript">
$('.datatable').DataTable({
  language: {
    "search": "{{__('translations.search')}}",
    "lengthMenu":     "{{__('translations.show')}} _MENU_ {{__('translations.entries')}}",
    "info":           "{{__('translations.show')}} _START_ {{__('translations.to')}} _END_ {{__('translations.of')}} _TOTAL_ {{__('translations.entries')}}",
    "loadingRecords": "{{__('translations.loading')}}",
    "show" : "rtyuio",
    "processing":     "{{__('translations.processing')}}",
    "emptyTable":"{{__('translations.No_data_available_in_table')}}",
    "paginate": {
      "first":      "{{__('translations.first')}}",
      "last":       "{{__('translations.last')}}",
      "next":       "{{__('translations.next')}}",
      "previous":   "{{__('translations.previous')}}",
  },
  "infoEmpty":      "{{__('translations.Showing_0_to_0_of_0_entries')}}",

}

});
$('#categories').DataTable({
  language: {
    "search": "{{__('translations.search')}}",
    "lengthMenu":     "{{__('translations.show')}} _MENU_ {{__('translations.entries')}}",
    "info":           "{{__('translations.show')}} _START_ {{__('translations.to')}} _END_ {{__('translations.of')}} _TOTAL_ {{__('translations.entries')}}",
    "loadingRecords": "{{__('translations.loading')}}",
    "show" : "rtyuio",
    "processing":     "{{__('translations.processing')}}",
    "emptyTable":"{{__('translations.No_data_available_in_table')}}",
    "paginate": {
      "first":      "{{__('translations.first')}}",
      "last":       "{{__('translations.last')}}",
      "next":       "{{__('translations.next')}}",
      "previous":   "{{__('translations.previous')}}",
  },
  "infoEmpty":      "{{__('translations.Showing_0_to_0_of_0_entries')}}",

}

});

</script>

<script type="text/javascript">
<?php /*
  $('#configurations').DataTable( {

      processing: true,

      serverSide: true,

      paging: false,



      ajax: "{{route('manage.configuration.all.data')}}",

      columns: [

      { data: 'name', name: 'name' },

      { data: 'value', name: 'value' },

      ]

  });
*/
?>
</script>

<script>

$(document).ready(function() {

    $('#example').DataTable(

 {

      processing: true,

      serverSide: true,

      ajax: "sql_to_json.php",

      columns: [

      { data: 'bank_name', name: 'bank_name' },

      { data: 'buy', name: 'buy' },

      { data: 'sell', name: 'sell' },

      { data: 'date', name: 'date' }

      ]

  }

);

} );

</script>



<script type="text/javascript">

  $('#subcategories').DataTable({
    language: {
      "search": "{{__('translations.search')}}",
      "lengthMenu":     "{{__('translations.show')}} _MENU_ {{__('translations.entries')}}",
      "info":           "{{__('translations.show')}} _START_ {{__('translations.to')}} _END_ {{__('translations.of')}} _TOTAL_ {{__('translations.entries')}}",
      "loadingRecords": "{{__('translations.loading')}}",
      "show" : "rtyuio",
      "processing":     "{{__('translations.processing')}}",
      "emptyTable":"{{__('translations.No_data_available_in_table')}}",
      "paginate": {
        "first":      "{{__('translations.first')}}",
        "last":       "{{__('translations.last')}}",
        "next":       "{{__('translations.next')}}",
        "previous":   "{{__('translations.previous')}}",
    },
    "infoEmpty":      "{{__('translations.Showing_0_to_0_of_0_entries')}}",

  }

  });
  $('#all_links').DataTable({
    language: {
      "search": "{{__('translations.search')}}",
      "lengthMenu":     "{{__('translations.show')}} _MENU_ {{__('translations.entries')}}",
      "info":           "{{__('translations.show')}} _START_ {{__('translations.to')}} _END_ {{__('translations.of')}} _TOTAL_ {{__('translations.entries')}}",
      "loadingRecords": "{{__('translations.loading')}}",
      "show" : "rtyuio",
      "processing":     "{{__('translations.processing')}}",
      "emptyTable":"{{__('translations.No_data_available_in_table')}}",
      "paginate": {
        "first":      "{{__('translations.first')}}",
        "last":       "{{__('translations.last')}}",
        "next":       "{{__('translations.next')}}",
        "previous":   "{{__('translations.previous')}}",
    },
    "infoEmpty":      "{{__('translations.Showing_0_to_0_of_0_entries')}}",

  }

  })

</script>



<script type="text/javascript">

  $('#products').DataTable({
    language: {
      "search": "{{__('translations.search')}}",
      "lengthMenu":     "{{__('translations.show')}} _MENU_ {{__('translations.entries')}}",
      "info":           "{{__('translations.show')}} _START_ {{__('translations.to')}} _END_ {{__('translations.of')}} _TOTAL_ {{__('translations.entries')}}",
      "loadingRecords": "{{__('translations.loading')}}",
      "show" : "rtyuio",
      "processing":     "{{__('translations.processing')}}",
      "emptyTable":"{{__('translations.No_data_available_in_table')}}",
      "paginate": {
        "first":      "{{__('translations.first')}}",
        "last":       "{{__('translations.last')}}",
        "next":       "{{__('translations.next')}}",
        "previous":   "{{__('translations.previous')}}",
    },
    "infoEmpty":      "{{__('translations.Showing_0_to_0_of_0_entries')}}",

  }

  });

</script>

<script type="text/javascript">

  var table = $('#movements').DataTable();
  table
    .order( [ 3, 'desc' ])
    .draw();

</script>

<script type="text/javascript">

$('#competitions').DataTable({
  language: {
    "search": "{{__('translations.search')}}",
    "lengthMenu":     "{{__('translations.show')}} _MENU_ {{__('translations.entries')}}",
    "info":           "{{__('translations.show')}} _START_ {{__('translations.to')}} _END_ {{__('translations.of')}} _TOTAL_ {{__('translations.entries')}}",
    "loadingRecords": "{{__('translations.loading')}}",
    "show" : "rtyuio",
    "processing":     "{{__('translations.processing')}}",
    "emptyTable":"{{__('translations.No_data_available_in_table')}}",
    "paginate": {
      "first":      "{{__('translations.first')}}",
      "last":       "{{__('translations.last')}}",
      "next":       "{{__('translations.next')}}",
      "previous":   "{{__('translations.previous')}}",
  },
  "infoEmpty":      "{{__('translations.Showing_0_to_0_of_0_entries')}}",

}

});

</script>



<script type="text/javascript">

  $('#orders').DataTable({
    language: {
      "search": "{{__('translations.search')}}",
      "lengthMenu":     "{{__('translations.show')}} _MENU_ {{__('translations.entries')}}",
      "info":           "{{__('translations.show')}} _START_ {{__('translations.to')}} _END_ {{__('translations.of')}} _TOTAL_ {{__('translations.entries')}}",
      "loadingRecords": "{{__('translations.loading')}}",
      "show" : "rtyuio",
      "processing":     "{{__('translations.processing')}}",
      "emptyTable":"{{__('translations.No_data_available_in_table')}}",
      "paginate": {
        "first":      "{{__('translations.first')}}",
        "last":       "{{__('translations.last')}}",
        "next":       "{{__('translations.next')}}",
        "previous":   "{{__('translations.previous')}}",
    },
    "infoEmpty":      "{{__('translations.Showing_0_to_0_of_0_entries')}}",

  }

  });

</script>



<script type="text/javascript">

  $('#customers').DataTable({
    language: {
      "search": "{{__('translations.search')}}",
      "lengthMenu":     "{{__('translations.show')}} _MENU_ {{__('translations.entries')}}",
      "info":           "{{__('translations.show')}} _START_ {{__('translations.to')}} _END_ {{__('translations.of')}} _TOTAL_ {{__('translations.entries')}}",
      "loadingRecords": "{{__('translations.loading')}}",
      "show" : "rtyuio",
      "processing":     "{{__('translations.processing')}}",
      "emptyTable":"{{__('translations.No_data_available_in_table')}}",
      "paginate": {
        "first":      "{{__('translations.first')}}",
        "last":       "{{__('translations.last')}}",
        "next":       "{{__('translations.next')}}",
        "previous":   "{{__('translations.previous')}}",
    },
    "infoEmpty":      "{{__('translations.Showing_0_to_0_of_0_entries')}}",

  }

  });

</script>

<script type="text/javascript">

  $('#histories').DataTable({
    language: {
      "search": "{{__('translations.search')}}",
      "lengthMenu":     "{{__('translations.show')}} _MENU_ {{__('translations.entries')}}",
      "info":           "{{__('translations.show')}} _START_ {{__('translations.to')}} _END_ {{__('translations.of')}} _TOTAL_ {{__('translations.entries')}}",
      "loadingRecords": "{{__('translations.loading')}}",
      "show" : "rtyuio",
      "processing":     "{{__('translations.processing')}}",
      "emptyTable":"{{__('translations.No_data_available_in_table')}}",
      "paginate": {
        "first":      "{{__('translations.first')}}",
        "last":       "{{__('translations.last')}}",
        "next":       "{{__('translations.next')}}",
        "previous":   "{{__('translations.previous')}}",
    },
    "infoEmpty":      "{{__('translations.Showing_0_to_0_of_0_entries')}}",

  }

  });

</script>



@if(isset($affiliate))

<script type="text/javascript">

  $('#links').DataTable( {

      processing: true,

      serverSide: true,

      ajax: "{{route('manage.affiliate.details.data', $affiliate->id)}}",

      columns: [

      { data: 'slug', name: 'slug' },

      { data: 'product.name', name: 'product.name' },

      { data: 'visits', name: 'visits' },

      { data: 'orders', name: 'orders' },

      { data: 'created_at', name: 'created_at' }

      ]

  });

</script>

@endif

<script type="text/javascript">

  $('#coupons').DataTable({
    language: {
      "search": "{{__('translations.search')}}",
      "lengthMenu":     "{{__('translations.show')}} _MENU_ {{__('translations.entries')}}",
      "info":           "{{__('translations.show')}} _START_ {{__('translations.to')}} _END_ {{__('translations.of')}} _TOTAL_ {{__('translations.entries')}}",
      "loadingRecords": "{{__('translations.loading')}}",
      "show" : "rtyuio",
      "processing":     "{{__('translations.processing')}}",
      "emptyTable":"{{__('translations.No_data_available_in_table')}}",
      "paginate": {
        "first":      "{{__('translations.first')}}",
        "last":       "{{__('translations.last')}}",
        "next":       "{{__('translations.next')}}",
        "previous":   "{{__('translations.previous')}}",
    },
    "infoEmpty":      "{{__('translations.Showing_0_to_0_of_0_entries')}}",

  }

  });

</script>

<?php
/*
<script type="text/javascript">

  $('#auctions').DataTable( {

      processing: true,

      serverSide: true,

      ajax: "{{route('manage.auctions.all.data')}}",

      columns: [
      { data: 'product_name', name: 'product_name' },
      { data: 'start_price', name: 'start_price' },
      { data: 'expiry_time', name: 'expiry_time' },
      { data: 'action', name: 'action', orderable: false, searchable: false}

      ]

  });

</script>
*/
?>
<script type="text/javascript">

  $('#threeQuantity').DataTable({
    language: {
      "search": "{{__('translations.search')}}",
      "lengthMenu":     "{{__('translations.show')}} _MENU_ {{__('translations.entries')}}",
      "info":           "{{__('translations.show')}} _START_ {{__('translations.to')}} _END_ {{__('translations.of')}} _TOTAL_ {{__('translations.entries')}}",
      "loadingRecords": "{{__('translations.loading')}}",
      "show" : "rtyuio",
      "processing":     "{{__('translations.processing')}}",
      "emptyTable":"{{__('translations.No_data_available_in_table')}}",
      "paginate": {
        "first":      "{{__('translations.first')}}",
        "last":       "{{__('translations.last')}}",
        "next":       "{{__('translations.next')}}",
        "previous":   "{{__('translations.previous')}}",
    },
    "infoEmpty":      "{{__('translations.Showing_0_to_0_of_0_entries')}}",

  }

  });

</script>

<script type="text/javascript">

  $('#zeroQuantity').DataTable({
    language: {
      "search": "{{__('translations.search')}}",
      "lengthMenu":     "{{__('translations.show')}} _MENU_ {{__('translations.entries')}}",
      "info":           "{{__('translations.show')}} _START_ {{__('translations.to')}} _END_ {{__('translations.of')}} _TOTAL_ {{__('translations.entries')}}",
      "loadingRecords": "{{__('translations.loading')}}",
      "show" : "rtyuio",
      "processing":     "{{__('translations.processing')}}",
      "emptyTable":"{{__('translations.No_data_available_in_table')}}",
      "paginate": {
        "first":      "{{__('translations.first')}}",
        "last":       "{{__('translations.last')}}",
        "next":       "{{__('translations.next')}}",
        "previous":   "{{__('translations.previous')}}",
    },
    "infoEmpty":      "{{__('translations.Showing_0_to_0_of_0_entries')}}",

  }

  });

</script>

<script type="text/javascript">

  $('#purchases').DataTable({
    language: {
      "search": "{{__('translations.search')}}",
      "lengthMenu":     "{{__('translations.show')}} _MENU_ {{__('translations.entries')}}",
      "info":           "{{__('translations.show')}} _START_ {{__('translations.to')}} _END_ {{__('translations.of')}} _TOTAL_ {{__('translations.entries')}}",
      "loadingRecords": "{{__('translations.loading')}}",
      "show" : "rtyuio",
      "processing":     "{{__('translations.processing')}}",
      "emptyTable":"{{__('translations.No_data_available_in_table')}}",
      "paginate": {
        "first":      "{{__('translations.first')}}",
        "last":       "{{__('translations.last')}}",
        "next":       "{{__('translations.next')}}",
        "previous":   "{{__('translations.previous')}}",
    },
    "infoEmpty":      "{{__('translations.Showing_0_to_0_of_0_entries')}}",

  }

  });

</script>

<script type="text/javascript">
$('#stores').DataTable({
  language: {
    "search": "{{__('translations.search')}}",
    "lengthMenu":     "{{__('translations.show')}} _MENU_ {{__('translations.entries')}}",
    "info":           "{{__('translations.show')}} _START_ {{__('translations.to')}} _END_ {{__('translations.of')}} _TOTAL_ {{__('translations.entries')}}",
    "loadingRecords": "{{__('translations.loading')}}",
    "show" : "rtyuio",
    "processing":     "{{__('translations.processing')}}",
    "emptyTable":"{{__('translations.No_data_available_in_table')}}",
    "paginate": {
      "first":      "{{__('translations.first')}}",
      "last":       "{{__('translations.last')}}",
      "next":       "{{__('translations.next')}}",
      "previous":   "{{__('translations.previous')}}",
  },
  "infoEmpty":      "{{__('translations.Showing_0_to_0_of_0_entries')}}",

}

});
/*
  $('#stores').DataTable( {

      processing: true,

      serverSide: true,



      ajax: "{{route('manage.store.all.data')}}",

      columns: [

      { data: 'name', name: 'name' },

      { data: 'address', name: 'address' },


      { data: 'action', name: 'action', orderable: false, searchable: false}

      ]

  });
*/
</script>

<script type="text/javascript">

  $('#user_orders').DataTable({
    language: {
      "search": "{{__('translations.search')}}",
      "lengthMenu":     "{{__('translations.show')}} _MENU_ {{__('translations.entries')}}",
      "loadingRecords": "{{__('translations.loading')}}",
      "info":           "{{__('translations.show')}} _START_ {{__('translations.to')}} _END_ {{__('translations.of')}} _TOTAL_ {{__('translations.entries')}}",
      "show" : "rtyuio",
      "processing":     "{{__('translations.processing')}}",
      "emptyTable":"{{__('translations.No_data_available_in_table')}}",
      "paginate": {
        "first":      "{{__('translations.first')}}",
        "last":       "{{__('translations.last')}}",
        "next":       "{{__('translations.next')}}",
        "previous":   "{{__('translations.previous')}}",
    },
    "infoEmpty":      "{{__('translations.Showing_0_to_0_of_0_entries')}}",

  }

  });

</script>


<script type="text/javascript">

  $('#accessories').DataTable({
    language: {
      "search": "{{__('translations.search')}}",
      "lengthMenu":     "{{__('translations.show')}} _MENU_ {{__('translations.entries')}}",
      "loadingRecords": "{{__('translations.loading')}}",
      "info":           "{{__('translations.show')}} _START_ {{__('translations.to')}} _END_ {{__('translations.of')}} _TOTAL_ {{__('translations.entries')}}",
      "show" : "rtyuio",
      "processing":     "{{__('translations.processing')}}",
      "emptyTable":"{{__('translations.No_data_available_in_table')}}",
      "paginate": {
        "first":      "{{__('translations.first')}}",
        "last":       "{{__('translations.last')}}",
        "next":       "{{__('translations.next')}}",
        "previous":   "{{__('translations.previous')}}",
    },
    "infoEmpty":      "{{__('translations.Showing_0_to_0_of_0_entries')}}",

  }

  });

</script>

<script type="text/javascript">
  $('#reason_holder').hide();
var snackbar = document.getElementById("snackbar");
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
  $('#add_quantity').click(function(e){
    var product_id = $("#product_uId").val();
    var quantity = $("#quantity").val();
    var store_id = $("#store_id").val();
    var shiporder_id = $('#shiporder_id').val();
    // alert(store_id);
    quantity = $.trim(quantity);
    product_id = $.trim(product_id);
    shiporder_id = $.trim(shiporder_id);

if (shiporder_id == '' || shiporder_id <= 0 || shiporder_id == 1) {
      alert('يجب  ان يبدا قم الطلبيه من  2');
     }

  if (shiporder_id.length > 9) {
      alert('يجب الا يزيد رقم الطلبيه عن  9 ارقام');
     }

     if (quantity == "" || quantity == 0 || quantity < 0 | quantity > 999999) {
      alert('يجب ان تكون الكمية ما بين 1 الي 6 ارقام فقط  واكبر من الصفر ');
     }

    

    if (product_id !== "" && quantity != "") {
            var data = {
                quantity: quantity,
                store_id: store_id,
                shiporder_id : shiporder_id,
            };
            $.ajax({
                url: '{{ url("/owner/manage/products/addQuantity/") }}/' + product_id,
                type: 'POST',
                data: data,
                success: function (data) {
                  if (data.code == 400) 
                  {
                     alert(data.message);
                    //snackbar.innerHTML = 'one';
                  }
                  else if (data.code == 200){
                      snackbar.innerHTML = "{{__('translations.quantity_added')}}";
                      snackbar.className = "show";
                      setTimeout(function () { snackbar.className = snackbar.className.replace("show", ""); }, 2000);
                      setTimeout(function () { window.location.assign(location.href) }, 2500);
                  }
                  // alert(data);
                }, error: function (error) {
                    snackbar.innerHTML = "{{__('translations.something_went_wrong')}}";
                    snackbar.className = "show";
                    setTimeout(function () { snackbar.className = snackbar.className.replace("show", ""); }, 2000);
                }
            });
        } else {
            snackbar.innerHTML = "{{__('translations.check_your_quantity')}}";
            snackbar.className = "show";
            setTimeout(function () { snackbar.className = snackbar.className.replace("show", ""); }, 2000);
        }
  })

  $('#subtract_quantity').click(function(e){
    // console.log('test');
    var shiporder_id = $('#shiporder_id').val();
    var quantity = $('#quantity').val();
  
  /*  if (quantity < 0) {
      var cust_qty = "{{__('translations.quantity_must_be_at_least_one')}}";
      alert(cust_qty);
    }*/
  
    if (shiporder_id == '') {
      var custom = "{{__('translations.enter_shiporder_id')}}";
      alert(custom);
    }
    $('#reason_holder').show();
    var product_id = $("#product_uId").val();
    var quantity = $("#quantity").val();
    var store_id = $("#store_id").val();
    var shiporder_id = $('#shiporder_id').val();
    // alert(store_id);
    var reason=$('#reason').val();
    quantity = $.trim(quantity);
    product_id = $.trim(product_id);
    shiporder_id = $.trim(shiporder_id);

    if (reason == '') {
      alert('يرجي  ادخال  السبب ');
     }

      if (reason.length > 250) {
      alert('يرجي ان يكون السبب مختصرا ولا يتعدي  250 حرف');
     }

    if(reason != ''){
    if (product_id !== "" && quantity != "") {
            var data = {
                quantity: quantity,
                store_id: store_id,
                reason: reason,
                shiporder_id : shiporder_id,
            };
            $.ajax({
                url: '{{ url("/owner/manage/products/deleteQuantity/") }}/' + product_id,
                type: 'post',
                data: data,
                success: function (data) {
                  if (data.code == 400) 
                  {
                     alert(data.message);
                    //snackbar.innerHTML = 'one';
                  }
                  else if(data.code == 408)
                  {
                     alert(data.message);
                  }
                  else if (data.code == 200){
                      // console.log(data);
                      snackbar.innerHTML = "{{__('translations.quantity_updated')}}";
                      snackbar.className = "show";
                      setTimeout(function () { snackbar.className = snackbar.className.replace("show", ""); }, 2000);
                      setTimeout(function () { window.location.assign(location.href) }, 2500);
                  }
                },
                 error: function (error) {
                   var quantity = $("#quantity").val();
                   if (quantity < 0) {
                      var cust_qty = "{{__('translations.quantity_must_be_at_least_one')}}";
                      alert(cust_qty);
                     // var _error = cust_qty;
                      // snackbar.innerHTML = _error;
                    }
                    else
                    {
                        var _error = error.responseJSON;
                        if(_error){
                        snackbar.innerHTML = _error;
                        snackbar.className = "show";
                        setTimeout(function () { snackbar.className = snackbar.className.replace("show", ""); }, 2000);
                        }else{
                        snackbar.innerHTML = "{{__('translations.something_went_wrong')}}";
                        snackbar.className = "show";
                        setTimeout(function () { snackbar.className = snackbar.className.replace("show", ""); }, 2000);
                        }
                    }
                }
            });
        } else {
            snackbar.innerHTML = "{{__('translations.check_your_quantity')}}";
            snackbar.className = "show";
            setTimeout(function () { snackbar.className = snackbar.className.replace("show", ""); }, 2000);
        }
      }else{
        snackbar.innerHTML = "{{__('translations.please_enter_your_reason')}}";
        snackbar.className = "show";
        setTimeout(function () { snackbar.className = snackbar.className.replace("show", ""); }, 2000);
      }
  })



</script>

{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.16.2/axios.js"></script>
<script type="text/javascript">
var old_stores = [];
  $('#stores_holder').hide();

  $('#forVendors').on('change',function(){
      var SelectedId=$('#forVendors').val();
      if(SelectedId!='choose vendor'){
      axios.get( '{{ url('/owner/manage/sellers/stores') }}/'+ SelectedId )
      //'/admin/public/owner/manage/sellers/stores/'
      .then(function(response) {
          if(response.data.response!=""){
              $('#store_id').html(response.data.response);
              $('#stores_holder').show();
          }else{
              $('#stores_holder').hide();
              $('#store_id').html('');
              alert('no stores for this vendor');
          }
      })
      .catch(function(error) {
          $('#stores_holder').hide();
          $('#store_id').html('');
          alert({{__('translations.something_went_wrong')}});
      });
      }
      $('#quantities_area').html('');
      old_stores = [];
  }); --}}

</script>
