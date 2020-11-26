@extends('owner_dashboard.master')
@section('body')

  <section class="content-header">
    <h1>
      {{trans('layout.All Products')}}
    </h1>
  </section>
<style type="text/css">
  .actionsmenu li a{
    font-size: 12px;
    padding-bottom: -55px;
  }
  .actionsmenu li {
    margin: -5px;
  }
   .actionsmenu li a:hover{
    background: blue;
  }
</style>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
    <div class="box-header">
      <h3 class="box-title"></h3>
    </div><!-- /.box-header -->
             
  <input type="text" class="" name="search_index" id="search_prods" placeholder="{{ __('translations.search') }}"> 

<br>

<div id="dynamic_content">
  
<?php // @include('owner_dashboard.products.table_body') ?>
 
   </div>


</div>
      </div>
    </div>
  </section>

<?php /* // <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> */ ?>
<script src="{{ asset('js/jquery.min.js') }}"></script>


  <script type="text/javascript">
       $(document).ready(function()
      {
        // event(); 

        /*function event(e)
        {
          if(window.location.reload()){
           e.preventDefault();
          }
        }*/
      
       fetch_data(); 

        function fetch_data(page, search_index = '')
        {
          $.ajax({
            //  url  : '{{ route("manage.products.all.ajax") }}',
              url  : '/owner/manage/products/ajax?page='+page+'&serach_index='+search_index,
              type : 'GET',
              data : { 'search_index' : search_index },
              success : function(data)
              {
               // alert(data); dynamic_content
               $('#dynamic_content').empty().html(data);
               // $('#table_body').empty().html(data);
               // $('#total_records').text(data.total_data);
              }
            });
            // alert('one');
        } 

         $('#search_prods').on('keyup', function()
         {
            var search_index = $(this).val();
            var page = $('#hidden_page').val();
            fetch_data(page, search_index);
          // fetch_data(search_index);
         });


         $(document).on('click', '.pagination a', function(event){
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $('#hidden_page').val(page);
            // var column_name = $('#hidden_column_name').val();
           // var sort_type = $('#hidden_sort_type').val();

            var search_index = $('#search_prods').val();

            $('li').removeClass('active');
                  $(this).parent().addClass('active');
            fetch_data(page, search_index);
           });

        
      });
  </script> 

@stop
