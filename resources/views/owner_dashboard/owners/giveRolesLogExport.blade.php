
    <table class="table table-bordered table-striped" id="vendors">
      <thead>
        <tr>
          <th style="text-align: right;"> {{__('translations.description')}}</th>
         <?php //  <th>{{__('translations.subject_id')}}</th> ?>
         <?php //  <th>{{__('translations.subject_type')}}</th> ?>
         <th style="text-align: right"> {{ __('translations.ip') }}</th>
         <th style="text-align: right">  {{ __('translations.created_at') }} </th>
        </tr>
      </thead>

      <tbody>
      @foreach($logged_requests as $key => $activity)                  
                <?php  $item = json_decode($activity->request); ?>
                        <tr> 
                            <td>
                             {{ __('translations.userroles_getlogged') }} 
                             @foreach ($item as $key => $value)
                                @if($key == 'admin_id') 
                                 <?php $admin = App\User::withTrashed()->where('id', $value)->first(); ?>
                                 ( {{  $admin->name }} )
                                @endif
                            @endforeach
                            </td> 
                            <td> {{ $activity->ip }}</td>
                            <td> {{ $activity->created_at }} 
                              <u> {{ $activity->created_at->diffForHumans() }} </u>
                            </td>
                           
                        </tr>
                      @endforeach
                    </tbody>
                  </table>

   