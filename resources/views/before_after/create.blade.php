@extends('layouts.master')



@section('content')

<div class="row mt">

<div class="col-lg-1"></div>

          		<div class="col-lg-10">



@include('layouts.error')

                  <div class="form-panel">



                  	  <h4 class="mb">Before-After Form </h4>



<form method="POST" action="{{url('before_after')}}" enctype="multipart/form-data">



{{csrf_field()}}



    <div class="form-group">

    <div class="row">

    <div class="col-lg-6">
    <label for="exampleFormControlFile1">Before Image</label>



<input type="file" class="form-control-file"  name="before_image" id="exampleFormControlFile1" accept="image/*">


    </div>
        <div class="col-lg-6">
        <label for="exampleFormControlFile1">After Image</label>



    <input type="file" class="form-control-file"  name="after_image" id="exampleFormControlFile1" accept="image/*">


        </div>
        </div>

    </div>


    <div class="form-group">
        <div class="row">
            <div class="col-lg-6">
                <label for="exampleFormControlSelect1">Status</label>
                <select class="form-control"  name="status" id="exampleFormControlSelect1">
                    <option value="0">Enable</option>
                    <option value="1">Disable</option>
                </select>
            </div>
            <div class="col-lg-6">
                <label for="exampleInputPassword1">Service Name</label>
                <select class="form-control"  name="service_id" id="exampleFormControlSelect1" required>
                    <option value="">Select One</option>
                    @foreach($serviceids as $serviceid)
                    <option value="{{$serviceid->id}}">{{$serviceid->name}}</option>
                    @endforeach
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