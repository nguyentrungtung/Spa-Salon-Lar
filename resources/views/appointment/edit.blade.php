@extends('layouts.master')

@section('content')

<script>

	$(function() {	

        $('select[name=service_id]').change(function() { 

            var service = $(this).val();

            $.ajax({

				type: 'get',						

                url: 'employee/'+service,

                success: function (result) {

                    console.log(result);

                    var elements="<option value = ''>"+"Choose One"+"</option>";

                    result.forEach(function(r) {

                        console.log(r);

                        var element = "<option  value="+r.id+">"+r.first_name+" "+r.last_name+"</option>";

                        if(elements!=null){

                        elements=elements+element;

                        }else{

                            elements=element;

                        }

                    });

                    console.log(elements)

                    document.getElementById("exampleFormControlSelectunique").innerHTML=elements;

                    

            },

            error: function (error) {

                console.log(error);

            }

            

        });						

             });

    });





$(document).ready(function () {

    $("#appintmentDate").datepicker({

        minDate: 0,

        dateFormat:"yy-mm-dd"

    });

});


$(function() {	

        $('select[name=employee_id]').change(function() { 

            var employee = $(this).val();

            //alert(employee);

            $.ajax({

				type: 'get',						

                url: 'appointment_time/'+employee,

                success: function (result) {

                    console.log(result);

                    var elements="<option value = ''>"+"Choose One"+"</option>";

                    result.forEach(function(r) {

                        console.log(r);

                        var element = "<option  value="+r.id+">"+r.time_slot+"</option>";

                        if(elements!=null){

                        elements=elements+element;

                        }else{

                            elements=element;

                        }

                    });

                    console.log(elements)

                    document.getElementById("exampleFormControlSelectunique1").innerHTML=elements;

                    

            },

            error: function (error) {

                console.log(error);

            }

            

        });						

             });

    });



</script>

<div class="row mt">
<div class="col-lg-1"></div>
          		<div class="col-lg-10">

                  @include('layouts.error')

                  @if(Session::has('warning'))

            <div class="row">

                <div class="col-xs-12">

                    <div class="alert alert-warning alert-dismissable">

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span

                                    aria-hidden="true">&times;</span></button>

                        {{ Session::get('warning') }}

                    </div>

                </div>

            </div>

        @endif

                  <div class="form-panel">

                  	  <h4 class="mb">Appointment Form</h4>

<form method="POST" action="{{url('appointment/'.$appointment->id)}}">

    {{csrf_field()}}

    <div class="form-group">
    <div class="row">

            <div class="col-lg-6">
        <label for="exampleInputPassword1">Service Name</label>

        <select class="form-control"  name="service_id" id="exampleFormControlSelect1" required>

        <option value="">Select One</option>

        @foreach($serviceids as $serviceid)

            <option value="{{$serviceid->id}}"  @if($serviceid->id == $appointment->service_id){{'selected'}}@endif>{{$serviceid->name}}</option>

        @endforeach

        </select>
        </div>
        <div class="col-lg-6">
        <label for="exampleInputPassword1">Employee Name</label>

        <select class="form-control"  name="employee_id" id="exampleFormControlSelectunique" required>

        <option value="">Select One</option>

        @foreach($data as $employeeid)

            <option value="{{$employeeid->id}}"  @if($employeeid->id == $appointment->employee_id){{'selected'}}@endif>{{$employeeid->first_name}} {{$employeeid->last_name}}</option>

        @endforeach

        </select>

        </div>
        </div>
    </div>


    <div class="form-group">
    <div class="row">

            <div class="col-lg-6">

    <label for="apointment-date">Appointment Date</label>

    <div class="input-group date" id="datepicker">

      <input class="form-control" value = "{{$appointment->appointment_date}}" name="appointment_date" id="appintmentDate" type="text" required>

      <span class="input-group-addon">

          <span class="fa fa-calendar"></span>

      </span>

    </div>
  </div>
  <div class="col-lg-6">
  <label for="exampleInputPassword1">Appointment Time</label>

    <select class="form-control"  name="appointment_time" id="exampleFormControlSelectunique1" required>

    @foreach($timeslotids as $timeslotid) 

     @if($timeslotid->status == 0)

         <option value="{{$timeslotid->id}}" @if($timeslotid->id == $appointment->appointment_time){{'selected'}}@endif >{{$timeslotid->time_slot}}</option>

     @endif

     @endforeach

   

</select>
  </div>
  </div>
</div>

  <!--  <div class="form-group">

    <label for="exampleInputEmail1">Appointment Date</label>

    <input type="date" class="form-control" name="appointment_date" value = "{{$appointment->appointment_date}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter First Name">

</div>-->


    <div class="form-group">
    <div class="row">

            <div class="col-lg-6">
        <label for="exampleFormControlSelect1">Payment_Status</label>

        <select class="form-control"  name="payment_status" id="exampleFormControlSelect1">

        <option value="0" @if($appointment->payment_status == 0){{'selected'}}@endif>Unpaid</option>

        <option value="1" @if($appointment->payment_status == 1){{'selected'}}@endif>Paid</option>     

        </select>
        </div>
        <div class="col-lg-6">
        <label for="exampleFormControlSelect1">Status</label>

        <select class="form-control"  name="status" id="exampleFormControlSelect1">

        <option value="0" @if($appointment->status == 0){{'selected'}}@endif>Enable</option>

        <option value="1" @if($appointment->status == 1){{'selected'}}@endif>Disable</option>

        </select>

        </div>
        </div>
    </div>
    <div class="form-group">
<div class="row">

            <div class="col-lg-6">
        <label for="exampleInputEmail1">Internal note</label>

        <input type="text" class="form-control" name="internal_note" value="{{$appointment->internal_note}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Internal note">
        </div>
        </div>
    </div>

   
  <button type="submit" class="btn btn-primary">Submit</button></br></br>

</form>

</div>

</div>
<div class="col-lg-1"></div>
</div>

@endsection