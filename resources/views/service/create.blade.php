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

                  	  <h4 class="mb">Service Form</h4>

<form method="POST" action="{{url('service')}}" enctype="multipart/form-data">

{{csrf_field()}}

<div class="form-group">
<div class="row">

            <div class="col-lg-6">

        <label for="exampleInputPassword1">Category Name</label>

        <select class="form-control"  name="category" id="exampleFormControlSelect1" required>

        <option value="">Select One</option>

        @foreach($categoryids as $categoryid)

        @if($categoryid->status == 0)

            <option value="{{$categoryid->id}}">{{$categoryid->category}}</option>

        @endif

        @endforeach

        </select>
        </div>
        <div class="col-lg-6">
        <label for="exampleInputEmail1">Service Name</label>

        <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name" required>

        </div>
        </div>
    </div>

   
    

   
    <div class="form-group">
    <div class="row">

            <div class="col-lg-6">
        <label for="exampleInputEmail1">Price</label>

        <input type="number" class="form-control" name="price" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Price($)" min="0" required  >        
        </div>
        <div class="col-lg-6">
        <label for="exampleFormControlFile1">Point</label>

        <input type="number" class="form-control" name="point" id="exampleFormControlFile1"  min="0">

        </div>
        </div>
    </div>

   

    <div class="form-group">

        <label for="exampleInputEmail1">Duration</label>

        <div class="row">

            <div class="col-lg-6">

            <div class="input-group">

      <span class="input-group-addon">HOUR</span>

      <input type="number" class="form-control" name="houre" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Hours" min="0" max="24" required> 

    </div>



                      

            </div>

            <div class="col-lg-6">

            <div class="input-group">

      <span class="input-group-addon">MINUTE</span>

      <input type="number" class="form-control" name="minute" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter minute" min="0"  max="59" required>         

    </div>

               

            </div>

        </div>    

    </div>
    <div class="form-group">
    <div class="row">

            <div class="col-lg-6">
        <label for="exampleFormControlFile1">Service Image</label>

        <input type="file" class="form-control-file" name="service_image" id="exampleFormControlFile1" accept="image/*" >
        </div>
        <div class="col-lg-6">

        <label for="exampleInputPassword1">Employee Name : </label>

        @if(isset($employeeids))

    @foreach($employeeids as $employeeid)

        @if($employeeid->status == 0)

    <div class="form-check" style = "padding-left:30px;">

  <label class="form-check-label">

    <input class="form-check-input" type="checkbox" name="employeeid[]" value="{{$employeeid->id}}">

   {{$employeeid->first_name}} {{$employeeid->last_name}}

  </label>

</div>

        @endif

        @endforeach 

        @endif     
        </div>
        </div>
    </div>

   
    <div class="form-group">
    <div class="row">

            <div class="col-lg-6">
        <label for="exampleFormControlSelect1">Status</label>

        <select class="form-control" name="status" id="exampleFormControlSelect1">

        <option value="0">Enable</option>

        <option value="1">Disable</option>

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