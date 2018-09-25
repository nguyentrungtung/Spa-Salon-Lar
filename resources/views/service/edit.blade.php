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



                  	  <h4 class="mb">Service Form </h4>



<form method="POST" action="{{url('service/'.$service->id)}}" enctype="multipart/form-data">



{{csrf_field()}}



<div class="form-group">

<div class="row">

            <div class="col-lg-6">

<label for="exampleInputPassword1">Category Name</label>




<select class="form-control"  name="category" id="exampleFormControlSelect1" required>



<option value="">Select One</option>



@foreach($categoryids as $categoryid)



    <option value="{{$categoryid->id}}"  @if($categoryid->id == $service->category_id){{'selected'}}@endif>{{$categoryid->category}}</option>



@endforeach



</select>

</div>
<div class="col-lg-6">

<label for="exampleInputEmail1">Service Name</label>



        <input type="text" class="form-control" name="name" value = "{{$service->name}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name" required>

</div>
</div>

</div>


   
  

    <div class="form-group">
    <div class="row">

            <div class="col-lg-6">



        <label for="exampleInputEmail1">Price</label>



        <input type="number" class="form-control" name="price" value = "{{$service->price}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Price" required>        

        </div>
        <div class="col-lg-6">
        <label for="exampleFormControlFile1">Point</label>

        <input type="number" class="form-control" value = "{{$service->point}}" name="point" id="exampleFormControlFile1">

        </div>
        </div>

    </div>




    <div class="form-group">



        <label for="exampleInputEmail1">Duration</label>



        <div class="row">



            <div class="col-lg-6">



            <div class="input-group">

      <span class="input-group-addon">HOUR</span>

      <input type="number" class="form-control" name="houre" value = "{{$service->houre}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Hours" required>

    </div>

            </div>



            <div class="col-lg-6">



            <div class="input-group">

      <span class="input-group-addon">MINUTE</span>

      <input type="number" class="form-control" name="minute" value = "{{$service->minute}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter minute" required>        

    </div>

            

            </div>



        </div>    



    </div>

    <div class="form-group">


    <div class="row">

            <div class="col-lg-6">

        <label for="exampleFormControlFile1">Service Image</label>



        <input type="file" class="form-control-file" name="service_image" id="exampleFormControlFile1" accept="image/*"></br>

        <img src="{{ url('storage/app/'.$service->service_image)}}" height="42" width="42">

        </div>
        <div class="col-lg-6">

        <label for="exampleInputPassword1">Employee Name : </label>



    @foreach($employeeids as $employeeid)



        @if($service->status == 0)



    <div class="form-check" style = "padding-left:30px;">



  <label class="form-check-label">



    <input class="form-check-input" type="checkbox" name="employeeid[]" value="{{$employeeid->id}}"  

  

   <?php $a= $service->employee_id; ?>

       

       @foreach($a as $b)

        

        @if($employeeid->id == $b)

       

        {{'checked'}}



       @endif

        @endforeach

       

>


   {{$employeeid->first_name}} {{$employeeid->last_name}}



  </label>



</div>

        @endif



        @endforeach



        
        </div>
        </div>

    </div>


    <div class="form-group">

    <div class="row">

            <div class="col-lg-6">




        <label for="exampleFormControlSelect1">Status</label>



        <select class="form-control" name="status" id="exampleFormControlSelect1">



        <option value="0" @if($service->status == 0){{'selected'}}@endif>Enable</option>



        <option value="1"@if($service->status == 1){{'selected'}}@endif>Disable</option>



        </select>

        </div>
        </div>

    </div>


    



    



    



  <button type="submit" class="btn btn-primary">Submit</button></br></br>



</form>



</div>

<div class="col-lg-1"></div>

        </div>    



    </div>



    



@endsection