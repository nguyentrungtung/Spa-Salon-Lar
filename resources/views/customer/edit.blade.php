@extends('layouts.master')



@section('content')







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



                  	  <h4 class="mb">Customer Form </h4>



<form method="POST" action="{{url('customer/'.$user->id)}}" enctype="multipart/form-data">



{{csrf_field()}}



    <div class="form-group">

    <div class="row">

            <div class="col-lg-6">


        <label for="exampleInputEmail1">First Name</label>

        <input type="text" class="form-control" value = "{{$user->first_name}}" name="fname" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter First Name" required>


        </div>
        <div class="col-lg-6">
        <label for="exampleInputEmail1">Last Name</label>



        <input type="text" class="form-control" name="lname" value = "{{$user->last_name}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Last Name" required>


        </div>
        </div>
    </div>


    <div class="form-group">
    <div class="row">

            <div class="col-lg-6">




        <label for="exampleInputEmail1">email</label>



        <input type="email" class="form-control" name="email" value = "{{$user->email}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email" required>
        </div>
        <div class="col-lg-6">

        <label for="exampleInputEmail1">Phone</label>



        <input type="text" class="form-control" value = "{{$user->phone}}" name="phone" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Number" pattern="[789][0-9]{9}">

        </div>
        </div>


    </div>



   


    <div class="form-group">

    <div class="row">

            <div class="col-lg-6">



    <label for="exampleFormControlSelect1">Gender</label>



    <select class="form-control"  name="gender" id="exampleFormControlSelect1">



    <option value="0" @if($user->gender == 0){{'selected'}}@endif>Male</option>



    <option value="1" @if($user->gender == 1){{'selected'}}@endif>Female</option>



    </select>

    </div>
    </div>

  </div>

  <div class="form-group">



    <label for="exampleFormControlFile1">Profile Image</label>



    <input type="file" class="form-control-file"  name="profile_image" id="exampleFormControlFile1" accept="image/*"></br>

    <img src="{{ url('storage/app/'.$user->profile_image)}}" height="42" width="42">



  </div>

  <!--  <div class="form-group">



    <label for="exampleFormControlSelect1">Status</label>



    <select class="form-control"  name="status" id="exampleFormControlSelect1">



      <option value="0">Enable</option>



      <option value="1">Disable</option>



    </select>



  </div>-->



    



  <button type="submit" class="btn btn-primary">Submit</button></br></br>



</form>



</div>



        </div>    

        <div class="col-lg-1"></div>

    </div>



    



@endsection