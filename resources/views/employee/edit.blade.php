@extends('layouts.master')



@section('content')

<script>

$(function() {	

        $('select[name=f_hour]').change(function() { 

            var timeslot = $(this).val();

           // alert(timeslot);

            $.ajax({

				type: 'get',						

                url: 'timeslot/'+timeslot,

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

                    document.getElementById("exampleFormControlSelectunique").innerHTML=elements;

                    

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



                  	  <h4 class="mb">Employee Form </h4>



<form method="POST" action="{{url('employee/'.$employee->id)}}" enctype="multipart/form-data">



{{csrf_field()}}



    <div class="form-group">
    <div class="row">

            <div class="col-lg-6">



        <label for="exampleInputEmail1">First Name</label>



        <input type="text" class="form-control" name="fname" value="{{$employee->first_name}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter First Name" required>

        </div>
        <div class="col-lg-6">
        <label for="exampleInputEmail1">Last Name</label>



        <input type="text" class="form-control"  name="lname" value="{{$employee->last_name}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Last Name" required>

        </div>
        </div>

    </div>


    <div class="form-group">

    <div class="row">

            <div class="col-lg-6">


    <label for="exampleFormControlFile1">Profile Image</label>



    <input type="file" class="form-control-file"  name="profile_image" value="" id="exampleFormControlFile1" accept="image/*"></br>

    <img src="{{ url('storage/app/'.$employee->profile_image)}}" height="42" width="42">

    </div>
    <div class="col-lg-6">
    <label for="exampleInputEmail1">Email address</label>



        <input type="email" class="form-control"  name="email" value="{{$employee->email}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" required>


    </div>
    </div>

  </div>



    <div class="form-group">

    <div class="row">

            <div class="col-lg-6">

        <label for="exampleInputPassword1">From Hours</label>



        <select class="form-control"  name="f_hour" id="exampleFormControlSelect1" required>

        <option value="">Choose One</option>

        @foreach($timeslotids as $timeslotid)



        @if($timeslotid->status == 0)



            <option value="{{$timeslotid->id}}" @if($timeslotid->id == $employee->from_hours){{'selected'}}@endif >{{$timeslotid->time_slot}}</option>



        @endif



        @endforeach



      



    </select>

    </div>
    <div class="col-lg-6">
    <label for="exampleInputPassword1">To Hours</label>



        <select class="form-control"  name="to_hour" id="exampleFormControlSelectunique" required>

        <option value="">Choose One</option>

        @foreach($timeslotids as $timeslotid)



        @if($timeslotid->status == 0)



            <option value="{{$timeslotid->id}}" @if($timeslotid->id == $employee->to_hours){{'selected'}}@endif >{{$timeslotid->time_slot}}</option>



        @endif



        @endforeach



      



    </select>


    </div>
    </div>

    </div>




    <div class="form-group">

    <div class="row">

            <div class="col-lg-6">

    <label for="exampleFormControlSelect1">Status</label>



    <select class="form-control"  name="status" id="exampleFormControlSelect1">



      <option value="0" @if($employee->status == 0){{'selected'}}@endif>Enable</option>



      <option value="1" @if($employee->status == 1){{'selected'}}@endif>Disable</option>



    </select>
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