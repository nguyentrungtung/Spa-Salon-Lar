@extends('layouts.master')



@section('content')


<script type="text/javascript">

    function do_this(){

        var checkboxes = document.getElementsByName('record[]');
        var button = document.getElementById('btn4');

        if(button.value == 'Select All'){
            for (var i in checkboxes){
                checkboxes[i].checked = 'FALSE';
            }
            button.value = 'Deselect'
        }else{
            for (var i in checkboxes){
                checkboxes[i].checked = '';
            }
            button.value = 'Select All';
        }
    }


    $(function() {	
        $(document).on('click', ".submit", function() {
            var val = [];
        $(':checkbox:checked').each(function(i){
          val[i] = $(this).val();
         //   alert(val[i]);
          
            $.ajax({
                url: "appointment/deletemul",
                type: "get",
                data: {
                    '_token': $('input[name = _token]').val(),
                    val: val[i],
                   
                },
                success: function(d) {
                    window.location.reload();
                }
           
            
        });		
    });			
             });
    });

    $(function(){
        setInterval(oneSecondFunction, 5000);
        });
        
        function oneSecondFunction() {
            $.ajax({
                url: "appointment/interval",
                type: "get",
                data: {
                    '_token': $('input[name = _token]').val(),
                   
                   
                },
                success: function(d) {
                   
                }
            });
        }

</script>




<div class="col-md-12 mt">


 @if(Session::has('success'))

            <div class="row">

                <div class="col-xs-12">

                    <div class="alert alert-success alert-dismissable">

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span

                                    aria-hidden="true">&times;</span></button>

                        {{ Session::get('success') }}

                    </div>

                </div>

            </div>

        @endif

                      <div class="content-panel">



                          <table class="table table-striped table-advance table-hover">



	                  	  	  <h4><a href="{{url('appointment/create')}}"><button class = "btn btn-primary">Add Appointment</button></a></h4>



	                  	  	  <hr>



                              <thead>



                              <tr>

                              <th class = "multi">
                                    <input type="button" id="btn4" class = "btn btn-success btn-xs" value="Select All" onClick="do_this()" />                                                         
                                    <button type="submit" name="submit" class = "btn btn-danger btn-xs submit" ><i class="fa fa-trash-o "></i></button>
                                </th>

                              <th>User Name</th>



                              <th>Service Name</th>



                              <th>Employee Name</th>



                              <th>Appointment Date</th>



                              <th>Appointment time</th>



                              <th>Service Duration</th>



                              <th>Amount</th>                             

                              <th>Internal note</th> 

                              <th>Payment status</th>



                              <th>Status</th>



                              <th>Edit</th>



                              <th>Delete</th>



                              </tr>



                              </thead>



                              <tbody>



                              @foreach($appointments as $appointment)



                              



                                <tr>
                                       <td><input type="checkbox" name="record[]" value="{{$appointment->id}}" class="checkbox"></td>


                                    <td>{{$appointment->user['first_name']}} {{$appointment->user['last_name']}}</td>



                                    <td>{{$appointment->service['name']}}</td>  



                                    <td>{{$appointment->employee['first_name']}} {{$appointment->employee['last_name']}}</td>



                                    <td>{{$appointment->appointment_date}}</td>



                                    <td>{{$appointment->timeslot['time_slot']}}</td> 



                                    <td>{{$appointment->service['houre']}} : {{$appointment->service['minute']}}</td>



                                    <td><label>$</label>{{$appointment->service['price']}}</td>                                   

                                    <td>@if($appointment->internal_note){{$appointment->internal_note}} @else {{'no any internal note'}}@endif</td>

                                    <td>@if($appointment->payment_status == 0)<span class="label label-warning label-mini">Unpaid</span>@else<span class="label label-success label-mini">Paid</span>@endif</td>



                                    <td>@if($appointment->status == 0)<span class="label label-success label-mini">Enable</span>@else<span class="label label-warning label-mini">Disable</span>@endif</td>



                                    <td><a href="{{'appointment/edit/'.$appointment->id}}" ><button class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></button></a></td>



                                    <td><a  onclick="return confirm('Are you sure you want to delete it');"  href="{{'appointment/delete/'.$appointment->id}}"><button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i></button></a></td>



                                </tr>



                                @endforeach 



                             



                              </tbody>



                          </table>



                      </div><!-- /content-panel -->



                  </div><!-- /col-md-12 -->

               




@endsection